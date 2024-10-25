<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'price',
        'product_code',
        'description',
        'category', // Change from 'category' to 'category_id'
        'quantity',
        'image',
        'customizable',
        'canvas_width',
        'canvas_height',
        'canvas_top',
        'canvas_left',
        'main_image',
        'img_gallery',
        'customizing_image',
        'best_seller',
        'featured',
        'item_sold',
        'total_revenue',
    ];

    // Define the relationship to Category
    public function category() {
        return $this->belongsTo(Category::class);
    }
}

