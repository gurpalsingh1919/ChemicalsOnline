<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDocumentation extends Model
{
    protected $fillable = [
        'name','slug', 'code', 'category', 'attributes', 'packaging','','proof_strength','formula',
        'grades', 'certification', 'image', 'notes', 'status'
    ];

    protected $casts = [
        'attributes' => 'array',
        'status' => 'boolean',
    ];

    public function supportingDocuments()
    {
        return $this->hasMany(SupportingDocument::class, 'document_id');
    }
}
