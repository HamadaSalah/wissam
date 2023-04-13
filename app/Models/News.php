<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = ['head', 'body', 'img',  'video', 'news_category_id'];

    public function category()
    {
        return $this->belongsTo(NewsCategory::class, 'news_category_id', 'id');
    }
    public function wishlist()
    {
        return $this->hasOne(Wishlist::class);
    }
}
