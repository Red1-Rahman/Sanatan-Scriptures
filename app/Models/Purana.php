<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purana extends Model
{
    protected $fillable = [
        'purana_number',
        'name_sanskrit',
        'name_english',
        'name_transliteration',
        'description',
        'total_chapters',
        'total_verses',
        'category',
    ];
}
