<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
     protected $fillable = [
        'name',
        'description',
        'slug',
        'variant',
        'price',
        'sku',
        'vendor',
        'option_1',
        'option_2',
        'option_3',
        'status',
    ];
     protected $appends = ['image_url'];
   /*public function categories()
   {
     // return $this->belongsTo(Category::class, 'category_id');
      return $this->belongsToMany(Category::class, 'product_categories');
   }*/
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id')
                    ->withTimestamps();
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function image()
    {
        return $this->hasOne(ProductImage::class)->oldest();
    }
    public function getImageUrlAttribute()
    {
        if ($this->relationLoaded('image') && $this->image) {
            return $this->image->full_url; // 👈 use accessor from ProductImage
        }

        return asset('storage/products/no-image.png');
    }

}
