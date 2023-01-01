<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $casts = [
        "date_start" => "datetime",
        "date_end" => "datetime",
    ];

    protected $fillable = [
        "title",
        "date_start",
        "date_end",
        "user_id",
        "type",
        "created_at",
        "updated_at",
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
