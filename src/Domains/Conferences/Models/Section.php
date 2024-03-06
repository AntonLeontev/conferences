<?php

namespace Src\Domains\Conferences\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Src\Domains\Auth\Models\User;

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

    public function moderators(): MorphToMany
    {
        return $this->morphToMany(User::class, 'moderable')
            ->withPivot('comment')
            ->withTimestamps();
    }

    protected static function booted(): void
    {
    }
}
