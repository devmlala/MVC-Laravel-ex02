<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivroFulano extends Model
{
    use HasFactory;


    protected $fillable = [
        'titulo', 'autor', 'isbn',
    ];


}
