<?php

namespace Src\Domains\Conferences\Models;

use App\Casts\DiscountCast;
use App\Casts\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Src\Domains\Auth\Models\Organization;
use Src\Domains\Conferences\Enums\AbstractsFormat;
use Src\Domains\Conferences\Enums\AbstractsLanguage;
use Src\Domains\Conferences\Enums\ConferenceFormat;
use Src\Domains\Conferences\Enums\ConferenceLanguage;
use Src\Domains\Conferences\Enums\ParticipantsNumber;
use Src\Domains\Conferences\Enums\ReportForm;

class Conference extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_ru',
        'title_en',
        'slug',
        'conference_type_id',
        'organization_id',
        'format',
        'with_foreign_participation',
        'logo',
        'website',
        'need_site',
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
        'participants_number' => ParticipantsNumber::class,
        'report_form' => ReportForm::class,
        'start_date' => 'date',
        'end_date' => 'date',
        'phone' => PhoneNumber::class,
        'co-organizers' => 'array',
        'discount_students' => DiscountCast::class,
        'discount_participants' => DiscountCast::class,
        'discount_special_guest' => DiscountCast::class,
        'discount_young_scientist' => DiscountCast::class,
    ];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

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

            if ($conferencesWithSlug >= 1) {
                $slug .= $conferencesWithSlug + 1;
            }

            $conference->slug = $slug;
        });
    }
}
