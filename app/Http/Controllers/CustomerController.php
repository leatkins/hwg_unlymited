<?php

namespace App\Http\Controllers;
use App\Models\Customer; 
use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function customerList() {
        return view('customers', [
            'customers' => DB::table('customers')->orderBy('first_name', 'asc')->paginate(25)
        ]); 
    }
}
