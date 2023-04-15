<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livechat extends Model
{
    use HasFactory;
    protected $fillable = ['user_id'];
    public function messages()
    {
        return $this->hasMany(Message::class)->latest();
    }
}