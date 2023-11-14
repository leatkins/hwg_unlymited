<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use App\Models\Customer; 
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderLineItem; 

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = DB::table('customers')->get(); 
        $customerCount = $customers->count(); 

        $products = DB::table('products')->get(); 
        $productCount = $products->count(); 

        $orderStatuses = ['PENDING', 'SHIPPED', 'COMPLETE', 'REFUNDED', 'CANCELED']; 

        $totalOrders = 50; 

        for ($x = 0; $x < $totalOrders; $x++) {
            $randCustomer = rand(1, $customerCount); 
            $randProduct = rand(1, $productCount); 
            $customer = Customer::find($randCustomer); 
            $product = Product::find($randProduct); 
            $order = new Order();
            $order->customer_id = $randCustomer; 
            $order->address_1 = $customer->address_1; 
            $order->address_2 = $customer->address_2; 
            $order->city = $customer->city; 
            $order->state = $customer->state; 
            $order->zip_code = $customer->zip_code; 
            $order->status = $orderStatuses[rand(0, 4)];
            $order->amount = $product->price;
            $order->save();


            $lineItem= new OrderLineItem(); 
            $lineItem->order_id = $order->id; 
            $lineItem->product_id = $product->id; 
            $lineItem->quantity = 1; 
            $lineItem->product_price = $product->price; 
            $lineItem->line_price = $product->price; 
            $lineItem->save(); 

        }
    }
}
