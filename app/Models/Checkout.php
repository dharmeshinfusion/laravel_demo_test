<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checkout extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'checkouts';
    protected $fillable = ['user_id','product_id','quantity','name','price','total_price','image','description'];
    public function ProductCheckout()
    {
        return $this->hasMany('App\Models\Product','id','product_id');
    }

}

