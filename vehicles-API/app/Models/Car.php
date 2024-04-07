<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'make',
        'model',
        'color',
        'registration_no'
    ];

    protected $casts = [
        'created_at'  => 'date:d-M-Y'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
