<?php

namespace Src\Domains\Conferences\Models;

use App\Casts\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Src\Domains\Auth\Models\Participant;
use Src\Domains\Conferences\Enums\ParticipationType;

class Participation extends Model
{
    use HasFactory;

    protected $fillable = [
        'participant_id',
        'conference_id',
        'name_ru',
        'surname_ru',
        'middle_name_ru',
        'name_en',
        'surname_en',
        'middle_name_en',
        'email',
        'phone',
        'affiliations',
        'orcid_id',
        'website',
        'participation_type',
        'is_young',
    ];

    protected $casts = [
        'phone' => PhoneNumber::class,
        'participation_type' => ParticipationType::class,
        'is_young' => 'boolean',
        'affiliations' => 'array',
    ];

    public function participant(): BelongsTo
    {
        return $this->belongsTo(Participant::class);
    }

    public function conference(): BelongsTo
    {
        return $this->belongsTo(Conference::class);
    }

    public function thesis(): HasOne
    {
        return $this->hasOne(Thesis::class);
    }
}
