<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Campos de la base de datos que el usuario puede llenar desde los formularios
    protected $fillable = [
        'category_id', 
        'barcode', 
        'name', 
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