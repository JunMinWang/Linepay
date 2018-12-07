<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['order_no', 'items', 'prices', 'status', 'payment_type', 'payment_status', 'memo'];
}
