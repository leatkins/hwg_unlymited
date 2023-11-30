<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderLineItem;
use App\Http\Controllers\MailOrderController;

class OrderController extends Controller
{
    public function getOrders(Request $request)
    {
        if(!empty($request->orderStatus)) {
            $orders = DB::table('orders')
                ->where('status', '=', $request->orderStatus)
                ->orderBy('created_at', 'desc')->paginate(15);

            if($request->orderStatus === 'ALL'){
                $orders = DB::table('orders')->whereIn('status', Order::ORDER_STATUS)->orderBy('created_at', 'desc')->paginate(20);
            }
        }else {

            $orders = DB::table('orders')->orderBy('created_at', 'desc')->paginate(20);
        }

        return view('dashboard', [
            'totalSales' => $this->ordersTotal(),
            'orders' => $orders]);

    }

    public function viewOrder($id)
    {
        $lineItems = DB::table('order_line_items')
            ->join('products', 'order_line_items.product_id', '=', 'products.id')
            ->where('order_line_items.order_id', '=', $id)
            ->get();
        return view('viewOrder', [
            'lineItems' => $lineItems,
            'order' => Order::find($id)
        ]);
    }

    public function updateOrder(int $id, Request $request)
    {
        $lineItems = DB::table('order_line_items')
            ->join('products', 'order_line_items.product_id', '=', 'products.id')
            ->where('order_line_items.order_id', '=', $id)
            ->get();
        $order = Order::find($id);
        $order->status = $request->orderStatus;
        $order->save();

        return view('viewOrder', [
            'lineItems' => $lineItems,
            'order' => Order::find($id)
        ]);
    }


    private function ordersTotal() {
        $orders =  DB::table('orders')->whereIn('status', ['PENDING', 'SHIPPED', 'COMPLETE'])->get();
        $total = 0.00;

        foreach($orders as $order) {
            $total = $total + $order->amount;
        }
        return number_format($total, 2);
    }

    public function addLineItem(int $id, Request $request)
    {
       $request->session()->push('lineItems', [
            'product_id' => $id,
            'quantity' => $request->quantity
        ]);

        return redirect('/products?item-added=true');
    }

    public function viewCart()
    {
        return view ('customer-cart');
    }

    public function clearCart(Request $request)
    {
        $request->session()->flush();
        return view ('customer-cart');
    }

    public function removeItem(int $id, Request $request):RedirectResponse
    {
        $lineItems = $request->session()->get('lineItems');

        unset($lineItems[$id]);
        $request->session()->put('lineItems', array_values($lineItems));

        return redirect('/cart');

    }

    public function completePayment(Request $request)
    {
        $orderData = json_decode($request->orderData);

        $existingCustomer = DB::table('customers')
            ->where('email_address', '=', $orderData->payer->email_address)
            ->first();

        if(empty($existingCustomer->id)) {
            $customer = new Customer();
            $customer->first_name = $orderData->payer->name->given_name;
            $customer->last_name = $orderData->payer->name->surname;
            $customer->email_address  = $orderData->payer->email_address;
            $customer->phone_number = '';
            $customer->address_1 = $orderData->purchase_units[0]->shipping->address->address_line_1;
            $customer->address_2 = $orderData->purchase_units[0]->shipping->address->address_line_2 ?? '';
            $customer->city = $orderData->purchase_units[0]->shipping->address->admin_area_2;
            $customer->state = $orderData->purchase_units[0]->shipping->address->admin_area_1;
            $customer->zip_code = $orderData->purchase_units[0]->shipping->address->postal_code;
            $customer->save();
        } else {
            $customer=Customer::find($existingCustomer->id);
            $customer->first_name = $orderData->payer->name->given_name;
            $customer->last_name = $orderData->payer->name->surname;
            $customer->email_address  = $orderData->payer->email_address;
            $customer->phone_number = '';
            $customer->address_1 = $orderData->purchase_units[0]->shipping->address->address_line_1;
            $customer->address_2 = $orderData->purchase_units[0]->shipping->address->address_line_2 ?? '';
            $customer->city = $orderData->purchase_units[0]->shipping->address->admin_area_2;
            $customer->state = $orderData->purchase_units[0]->shipping->address->admin_area_1;
            $customer->zip_code = $orderData->purchase_units[0]->shipping->address->postal_code;
            $customer->save();
        }
        $order = new Order();
        $order->customer_id = $customer->id;
        $order->address_1 = $orderData->purchase_units[0]->shipping->address->address_line_1;
        $order->address_2 = $orderData->purchase_units[0]->shipping->address->address_line_2 ?? '';
        $order->state = $orderData->purchase_units[0]->shipping->address->admin_area_1;
        $order->city = $orderData->purchase_units[0]->shipping->address->admin_area_2;
        $order->zip_code = $orderData->purchase_units[0]->shipping->address->postal_code;
        $order->status = 'PENDING';
        $order->confirmation_number = $orderData->id;
        $order->amount = number_format(($orderData->purchase_units[0]->amount->value / 100), 2);
        $order->save();

        $lineItems = $request->session()->get('lineItems');

        foreach ($lineItems as $item) {
            $orderLineItem = new OrderLineItem();
            $orderLineItem->order_id = $order->id;
            $orderLineItem->product_id = $item['product_id'];
            $orderLineItem->quantity = $item['quantity'];

            $product = Product::find($item['product_id']);
            $product->inventory_count = $product->inventory_count - $item['quantity'];
            $product->save();

            $orderLineItem->product_price = $product->price;
            $orderLineItem->line_price = $product->price * $item['quantity'];
            $orderLineItem->save();
        }
        $request->session()->flush();
        $mailOrder = new MailOrderController($order->id);
        $mailOrder->sendMail();
        return redirect('/orderComplete/' . $order->id);

    }

    public function orderComplete($id)
    {
        $lineItems = DB::table('order_line_items')
            ->join('products', 'order_line_items.product_id', '=', 'products.id')
            ->where('order_line_items.order_id', '=', $id)
            ->get();
        return view('web-thankyou', [
            'lineItems' => $lineItems,
            'order' => Order::find($id)
        ]);
    }


}
