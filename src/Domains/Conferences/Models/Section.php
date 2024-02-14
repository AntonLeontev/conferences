<?php

namespace Src\Domains\Conferences\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'conference_id',
        'short_title_ru',
        'title_ru',
        'short_title_en',
        'title_en',
    ];

    public function conference(): BelongsTo
    {
        return $this->belongsTo(Conference::class);
    }

    public function theses(): HasMany
    {
        return $this->hasMany(Thesis::class);
    }

    protected static function booted(): void
    {
        static::creating(function (Section $section) {
            $slug = str($section->title_en)->slug()->value();

            $sectionsWithSlug = Section::query()
                ->where('slug', 'like', $slug.'%')
                ->where('conference_id', $section->conference_id)
                ->count();

            if ($sectionsWithSlug >= 1) {
                $slug .= $sectionsWithSlug + 1;
            }

            $section->slug = $slug;
        });
    }
}
