<?php

namespace Src\Domains\Conferences\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Src\Domains\Conferences\Enums\ReportForm;

class Thesis extends Model
{
    use HasFactory;

    protected $fillable = [
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
        'report_form' => ReportForm::class,
        'authors' => 'array',
        'reporter' => 'array',
        'contact' => 'array',
    ];

    public function participation(): BelongsTo
    {
        return $this->belongsTo(Participation::class);
    }
}
