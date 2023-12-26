<?php

namespace App\Models;

use Orchid\Screen\AsSource;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model
};

class Joke extends Model
{
    use HasFactory, AsSource;

    protected $fillable = [
        'title', 'body', 'source'
    ];
}
