<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public const ORDER_STATUS = ['PENDING', 'SHIPPED', 'COMPLETE', 'REFUNDED', 'CANCELED']; 
}
