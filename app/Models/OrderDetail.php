<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = ['order_code', 'title', 'price', 'quantity','order_id'];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    use HasFactory;
}
