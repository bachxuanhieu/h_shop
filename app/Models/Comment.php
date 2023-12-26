<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'product_id',
        'name',
        'email',
        'content',
        'status'
    ];

    public function product(){
        return $this-> belongsTo(Product::class, 'product_id','id');
    }
}
