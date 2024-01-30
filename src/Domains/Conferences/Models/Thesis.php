<?php

namespace Src\Domains\Conferences\Models;

use App\Casts\ThesisTitleCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    protected static function booted(): void
    {
        static::creating(function (Thesis $thesis) {
            $conference = $thesis->load('participation')->participation->conference;
            $conference->loadCount('theses');
            $number = $conference->theses_count + 1;

            if (! is_null($thesis->section_id)) {
                $section = Section::find($thesis->section_id);
                $thesis->thesis_id = sprintf(
                    '%s-%s-%s',
                    $conference->slug,
                    $section->short_title_en,
                    $number
                );
            } else {
                $thesis->thesis_id = sprintf(
                    '%s-%s',
                    $conference->slug,
                    $number
                );
            }
        });
    }
}
