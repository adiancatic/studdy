<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "order",
        "note_id",
    ];

    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn () => "/quizzes/{$this->id}"
        );
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function entries(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(QuizEntry::class);
    }

    public function logs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(QuizLog::class);
    }
    

    public function save(array $options = [])
    {
        if (! $this->user_id) {
            $this->user_id = Auth::user()->id;
        }

        return parent::save($options);
    }
}
