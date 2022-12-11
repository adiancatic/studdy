<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    public const PARENT_ID = "notebook_id";

    protected $fillable = [
        "title",
        "content",
        "notebook_id",
    ];

    public function notebook(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Notebook::class);
    }

    public function title(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($this->attributes["title"] === null || $this->attributes["title"] === "") ? "Untitled" : $value
        );
    }

    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn () => "/notebooks/{$this->notebook_id}/{$this->id}"
        );
    }
}
