<?php

namespace Src\Domains\Conferences\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Src\Domains\Conferences\Enums\AbstractsFormat;
use Src\Domains\Conferences\Enums\AbstractsLanguage;
use Src\Domains\Conferences\Enums\ConferenceFormat;
use Src\Domains\Conferences\Enums\ConferenceLanguage;

class Conference extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_ru',
        'title_en',
        'slug',
        'conference_type_id',
        'format',
        'with_foreign_participation',
        'logo',
        'website',
        'co-organizers',
        'address',
        'phone',
        'email',
        'start_date',
        'end_date',
        'description_ru',
        'description_en',
        'lang',
        'participants_number',
        'report_form',
        'whatsapp',
        'telegram',
        'price_participants',
        'price_visitors',
        'discount_students',
        'discount_participants',
        'discount_special_guest',
        'discount_young_scientist',
        'abstracts_price',
        'abstracts_format',
        'abstracts_lang',
    ];

    protected $casts = [
        'format' => ConferenceFormat::class,
        'lang' => ConferenceLanguage::class,
        'abstracts_format' => AbstractsFormat::class,
        'abstracts_lang' => AbstractsLanguage::class,
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(ConferenceType::class);
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class);
    }

    protected static function booted(): void
    {
        static::creating(function (Conference $conference) {
            $slug = str($conference->title_en)->slug()->value();

            $conferencesWithSlug = Conference::where('slug', 'like', $slug.'%')->count();

            if ($conferencesWithSlug > 1) {
                $slug .= $conferencesWithSlug + 1;
            }

            $conference->slug = $slug;
        });
    }
}
