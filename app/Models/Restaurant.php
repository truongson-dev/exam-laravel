<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'T_restaurant';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'category',
        'price',
        'description',
        'image',
        'status',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'price' => 'decimal:2',
        'status' => 'integer',
    ];

    /**
     * Scope: filter by category
     */
    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope: only available items
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 1);
    }

    /**
     * All allowed categories
     */
    public static function categories(): array
    {
        return ['Cơm Dĩa', 'Bánh mỳ', 'Bú phở'];
    }
}