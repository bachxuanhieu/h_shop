<?php

namespace App\Models;
use App\Models\Order_item;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'fullname',
        'email',
        'phone',
        'address',
        'status',
        'payment_mode',
    ];

    public function orderItems(){
        return $this->hasMany(Order_item::class,'order_id','id');
    }
}
