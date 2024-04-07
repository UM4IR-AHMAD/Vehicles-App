<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $casts = [
        'created_at'  => 'date:d-M-Y'
    ];


    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
