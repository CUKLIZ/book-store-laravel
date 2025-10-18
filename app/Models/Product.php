<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'author',
        'description',
        'price',
        'stock',
        'image',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function carts() {
        return $this->hasMany(Cart::class);
    }

    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }

    public function genres()
    {
        // Parameter pertama: Model yang akan dihubungkan (Genre::class).
        // Parameter kedua (opsional): Nama tabel pivot (default: 'genre_product').
        return $this->belongsToMany(Genre::class, 'genre_product');
    }
}
