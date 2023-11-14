<?php

namespace App\Http\Livewire;

use LaravelViews\Views\TableView;
use App\Models\Order; 

class OrdersTableView extends TableView
{
    /**
     * Sets a model class to get the initial data
     */
    protected $model = Order::class;

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            'Order Status',
            'Customer', 
            'Address',
            'Order Total',
            'Created On'

        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        return [
            $model->status,
            $model->customer_id, 
            $model->address_1 . ' ' . $model->address_2 . ' ' . $model->city . ', ' . $model->state . ' ' . $model->zip_code, 
            $model->amount, 
            $model->created_at
        ];
    }
}
