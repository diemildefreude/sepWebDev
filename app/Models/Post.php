<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'title';
    }

    protected $fillable =
    [
        'title',
        'subtitle', 
        'live_url',
        'code_url',
        'tech_stack',
        'features',
        'desktop_img',
        'laptop_img',
        'tablet_img',
        'phone_img'
    ];
}
