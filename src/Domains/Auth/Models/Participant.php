<?php

namespace Src\Domains\Auth\Models;

use App\Casts\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    ];

    protected $casts = [
        'phone' => PhoneNumber::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
