<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'birthday'];

    protected $casts = [
        'birthday' => 'datetime:Y-m-d',
    ];

    public function books() : HasMany
    {
        return $this->hasMany(Book::class);
    }
}
