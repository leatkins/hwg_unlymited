<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function customerList(Request $request) : View
    {
        $customers = DB::table('customers')->orderBy('first_name', 'asc')->paginate(25);
        if (!empty($request->search)) {
            $customers = DB::table('customers')
                ->where('first_name', 'LIKE', '%'. $request->search . '%')
                ->orWhere('last_name', 'LIKE', '%'. $request->search . '%' )->paginate(25);
        }

        return view('customers', [
            'customers' => $customers
        ]);
    }

    public function customerView($id) : View
    {
        $customer = Customer::find($id);
        $orders = DB::table('orders')
            ->where('customer_id', '=', $id)
            ->orderBy('created_at', 'DESC')
            ->paginate(25);
        return view('view-customer', [
            'customer' => $customer,
            'orders' => $orders
        ]);
    }
}
