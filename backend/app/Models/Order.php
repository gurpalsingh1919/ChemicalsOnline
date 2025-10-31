<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;
use App\Models\Address;
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
        'shipping_address_id',
        'billing_address_id'
       
    ];
    public function items()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function billing()
    {
        return $this->belongsTo(Address::class,'billing_address_id');
    }
    public function shipping()
    {
        return $this->belongsTo(Address::class,'shipping_address_id');
    }
}
