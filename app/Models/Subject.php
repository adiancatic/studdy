<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\Auth;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "title",
        "icon",
    ];

    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn () => "/subjects/{$this->id}"
        );
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function notebooks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Notebook::class);
    }

    public function notes(): HasManyThrough
    {
        return $this->hasManyThrough(Note::class, Notebook::class);
    }

    public function save(array $options = [])
    {
        if (! $this->user_id) {
            $this->user_id = Auth::user()->id;
        }

        return parent::save($options);
    }
}
