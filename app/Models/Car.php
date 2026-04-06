<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Mf;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'model',
        'produced_on',
        'image',
        'mf_id'
    ];

    public function mf(): BelongsTo
    {
        return $this->belongsTo(Mf::class, 'mf_id', 'id');
    }
}
