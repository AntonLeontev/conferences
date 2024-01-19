<?php

namespace Src\Domains\Auth\Models;

use App\Casts\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Src\Domains\Conferences\Models\Conference;
use Src\Domains\Conferences\Models\Participation;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name_ru',
        'surname_ru',
        'middle_name_ru',
        'name_en',
        'surname_en',
        'middle_name_en',
        'phone',
        'affiliations',
        'orcid_id',
        'website',
    ];

    protected $casts = [
        'phone' => PhoneNumber::class,
        'affiliations' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function participations(): HasMany
    {
        return $this->hasMany(Participation::class);
    }

    public function conferences(): HasManyThrough
    {
        return $this->hasManyThrough(Conference::class, Participation::class);
    }
}
