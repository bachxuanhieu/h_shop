<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newscategory extends Model
{
    use HasFactory;

    protected $table = 'news_category';

    protected $fillable = [
        "name",
        "desc",
        "status",
        "image",
    ];


    public function new(){
        return $this->hasMany(News::class, 'newscategory_id', 'id');
    }
}
