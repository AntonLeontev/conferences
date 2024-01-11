<?php

namespace Src\Domains\Auth\Models;

use App\Casts\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name_ru',
        'short_name_ru',
        'full_name_en',
        'short_name_en',
        'inn',
        'address',
        'phone',
        'whatsapp',
        'telegram',
        'type',
        'actions',
        'vk',
        'logo',
    ];

    protected $casts = [
        'phone' => PhoneNumber::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
