<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('price');
            $table->string('item_sold')->nullable();
            $table->string('product_code');
            $table->text('description');
            $table->string('category');
            $table->string('quantity');
            $table->boolean('customizable')->default(false);
            $table->boolean(column: 'featured')->default(false);
            $table->boolean(column: 'best_seller')->default(false);
            $table->string('main_image');
            $table->text('img_gallery')->nullable();
            $table->string('customizing_image')->nullable();
            $table->integer('canvas_width')->nullable();
            $table->integer('canvas_height')->nullable();
            $table->integer('canvas_top')->nullable();
            $table->integer('canvas_left')->nullable();
            $table->string('color')->nullable();
            $table->string('total_revenue')->nullable();
            $table->tinyInteger('status')->default(1); 
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
