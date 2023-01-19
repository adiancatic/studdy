<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public function save(array $options = [])
    {
        if (! $this->user_id) {
            $this->user_id = Auth::user()->id;
        }

        return parent::save($options);
    }
}
