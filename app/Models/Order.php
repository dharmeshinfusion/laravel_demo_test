<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['first_name', 'last_name', 'address', 'pincode', 'country', 'user_id', 'invoice_no', 'product_id', 'quantity', 'name', 'price', 'total_price', 'image', 'description'];
}
