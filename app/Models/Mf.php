<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Car;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mf extends Model
{
    use HasFactory;

    protected $fillable = ['mf_name'];

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class, 'mf_id', 'id');
    }
}
