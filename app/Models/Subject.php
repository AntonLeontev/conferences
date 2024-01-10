<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_ru',
        'title_en',
        'slug',
    ];

    protected static function booted(): void
    {
        static::creating(function (Subject $subject) {
            $subject->slug = str($subject->title_en)->slug()->value();
        });
    }
}
