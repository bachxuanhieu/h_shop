<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Subcategory extends Model
{
    use HasFactory;

    protected $table = 'subcategories';

    protected $fillable = [
        'name','category_id','desc','image','status'
    ];

    public function category(){
        return $this-> belongsTo(Category::class, 'category_id','id');
    }
}

