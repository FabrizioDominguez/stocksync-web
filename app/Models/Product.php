<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\BelongsToTenant;

class Product extends Model
{
    use HasFactory, BelongsToTenant;

    // Campos de la base de datos que el usuario puede llenar desde los formularios
    protected $fillable = [
        'category_id', 
        'barcode', 
        'name', 
        'image_path',
        'technical_specs', 
        'price', 
        'stock', 
        'min_stock', 
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}