<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    use HasFactory;
    protected $fillable = ['image', 'product_id'];
    protected $appends = ['full_url'];
    //protected $appends = ['image_url'];
    public function getFullUrlAttribute()
    {
        return ($this->image != '') 
            ? asset('storage/' . $this->image) 
            : asset('storage/no-image.png');
    }
   

}
