<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'categorie',
        'title',
        'author',
        'description',
        'total_quantity',
    ];

    public function category()
    {
        return $this->belongsTo(Categorie::class, 'categorie');
    }
}