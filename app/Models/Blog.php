<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'image',
        'title',
        'description',
        'content'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
