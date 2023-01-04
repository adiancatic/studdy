<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "title",
        "icon",
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function notebooks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Notebook::class);
    }

    public function save(array $options = [])
    {
        if (! $this->user_id) {
            $this->user_id = Auth::user()->id;
        }

        return parent::save($options);
    }
}
