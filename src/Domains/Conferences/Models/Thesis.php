<?php

namespace Src\Domains\Conferences\Models;

use App\Casts\ThesisTitleCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use RuntimeException;
use Src\Domains\Conferences\Enums\ReportForm;

class Thesis extends Model
{
    use HasFactory;

    protected $fillable = [
        'thesis_id',
        'participation_id',
        'section_id',
        'report_form',
        'title',
        'authors',
        'reporter',
        'contact',
        'text',
    ];

    protected $casts = [
        'title' => ThesisTitleCast::class,
        'report_form' => ReportForm::class,
        'authors' => 'array',
        'reporter' => 'array',
        'contact' => 'array',
    ];

    public function participation(): BelongsTo
    {
        return $this->belongsTo(Participation::class);
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    protected static function booted(): void
    {
        static::creating(function (Thesis $thesis) {
            $conference = $thesis->load(['participation'])->participation->conference;

            if ($conference->sections->isEmpty()) {
                $conference->loadCount('theses');
                $number = (string) ($conference->theses_count + 1);

                $thesis->thesis_id = sprintf(
                    '%s%s',
                    $conference->slug,
                    str_pad($number, 3, '0', STR_PAD_LEFT)
                );
            } else {
                if (is_null($thesis->section_id)) {
                    throw new RuntimeException('Сохранение тезисов бeз указания секции, хотя в конференции есть секции');
                }

                $thesesInSectionCount = Thesis::where('section_id', $thesis->section_id)->count();
                $number = (string) ($thesesInSectionCount + 1);

                $section = Section::find($thesis->section_id);
                $thesis->thesis_id = sprintf(
                    '%s-%s%s',
                    $conference->slug,
                    $section->short_title_en,
                    str_pad($number, 3, '0', STR_PAD_LEFT)
                );
            }
        });
    }
}
