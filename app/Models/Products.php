<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'url',
        'name',
        'description',
        'image',
        'url',
        'price',
        'pro-price',
        'display',
        'new',
        'discount',
        'keyword_focus',
        'seo_title',
        'seo_keywords',
        'seo_description',
        'images'
    ];
    public function setFilenamesAttribute($value)
    {
        $this->attributes['images'] = json_encode($value);
    }
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
