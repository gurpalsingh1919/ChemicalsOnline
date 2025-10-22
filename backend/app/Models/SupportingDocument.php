<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportingDocument extends Model
{
    protected $fillable = ['name', 'document_id', 'image', 'status'];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function productDocumentation()
    {
        return $this->belongsTo(ProductDocumentation::class, 'document_id');
    }
}
