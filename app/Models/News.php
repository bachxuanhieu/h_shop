<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = "news";

    protected $fillable = [
        'newscategory_id',
        'name',
        'desc',
        'image',
        'status',
        'author'
    ];
    public function newscategory(){
        return $this->belongsTo(Newscategory::class,'newscategory_id', 'id');
    }
    

}
