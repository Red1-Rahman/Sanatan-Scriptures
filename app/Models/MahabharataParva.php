<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MahabharataParva extends Model
{
    protected $fillable = [
        'parva_number',
        'name_sanskrit',
        'name_english',
        'name_transliteration',
        'description',
        'total_chapters',
        'total_verses',
    ];

    public function bhagavadGitaVerses()
    {
        return $this->hasMany(BhagavadGitaVerse::class, 'parva_number', 'parva_number');
    }
}
