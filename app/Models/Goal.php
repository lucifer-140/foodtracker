<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'daily_calories',
        'daily_protein',
        'daily_fat',
        'daily_carbs',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
