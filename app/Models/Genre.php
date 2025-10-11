<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'name',
        'slug',
    ];

    // --- RELATIONS ---

    /**
     * Get the category that the Genre belongs to (One-to-Many inverse).
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the products associated with the Genre (Many-to-Many).
     *
     * Relasi ini menggunakan tabel pivot 'genre_product'.
     */
    public function products()
    {
        // Parameter pertama: Model yang akan dihubungkan (Product::class).
        // Parameter kedua (opsional): Nama tabel pivot (default: 'genre_product').
        return $this->belongsToMany(Product::class, 'genre_product');
    }
}