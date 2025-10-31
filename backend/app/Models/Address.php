<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'address_type', 'first_name', 'last_name', 'address',
        'apartment', 'city', 'state', 'pincode', 'country', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function country_name()
    {
        return $this->belongsTo(Country::class,'country');
    }
    public function state_name()
    {
        return $this->belongsTo(State::class,'state');
    }
}
