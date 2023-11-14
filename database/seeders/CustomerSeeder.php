<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = 25; 

        for ($x = 0; $x <= $count ; $x++ ) {
            $customer = new Customer(); 
            $customer->first_name = fake()->firstName(); 
            $customer->last_name = fake()->lastName(); 
            $customer->email_address = fake()->email(); 
            $customer->phone_number = fake()->phoneNumber(); 
            $customer->address_1 = fake()->streetAddress(); 
            $customer->city = fake()->city(); 
            $customer->state = fake()->state();
            $customer->zip_code = fake()->postcode(); 
            $customer->save(); 
            
        }
   
    }
}
