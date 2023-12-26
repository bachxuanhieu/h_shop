<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\ProductImage;

use App\Models\ProductProperty;
use App\Models\Comment;
class Product extends Model
{
    use HasFactory;

    protected $table="products";

    protected $fillable=[
        'category_id',
        'subcategory_id',
        'name',
        'slug',
        'brand_id',
        'small_desc',
        'desc',
        'old_price',
        'selling_price',
        'trending',
        'status',
        'properties'
    ];


    public function category(){
        return $this->belongsTo(Category::class,'category_id', 'id');
    }

    public function productImages(){
        return $this->hasMany(ProductImage::class,'product_id','id');
    }

    public function productProperties(){
        return $this->hasMany(ProductProperty::class,'product_id','id');
    }

    public function productComments(){
        return $this->hasMany(Comment::class,'product_id','id');
    }
}
