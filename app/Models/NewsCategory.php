<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'img'];
    public function categories()
    {
        return $this->hasMany(NewsCategory::class, 'category', 'id');
    }
}
