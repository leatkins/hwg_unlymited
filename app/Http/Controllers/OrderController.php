<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB; 
use App\Models\Order;
use App\Models\Product; 

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


}
