<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order_item extends Model
{
    use HasFactory;

    protected $table="order_items"; 

    protected $fillable=[
        'order_id',
        'product_id',
        'property_id',
        'quanlity',
        'price',
        'image'
    ];

    /**
     * Get the user that owns the Orderitem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

     /**
     * Get the user that owns the Orderitem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productProperty(): BelongsTo
    {
        return $this->belongsTo(Property::class, 'property_id', 'id');
    }

    // public function order(){
    //     return $this->belongsTo(Order::class,'order_id', 'id');
    // }
}
