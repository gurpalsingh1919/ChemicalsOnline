<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_id',
        'payer_id',
        'amount',
        'status',
        'items',
       
    ];
    public function items()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
