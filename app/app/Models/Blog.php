<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    public function tags()
    {
        return $this->hasMany(Tag::class);
    } 

    public function image()
    {
        return $this->hasOne(Image::class);
    }
}
