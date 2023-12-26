<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Property;

class ProductProperty extends Model
{
    use HasFactory;

    protected $table= 'product_properties';

    protected $fillable= [
        'product_id',
        'property_id',
        'price_product',
        'quantity',
        'image'
    ];

 
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'id');
    }
}
