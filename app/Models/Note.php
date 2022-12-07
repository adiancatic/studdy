<?php

namespace App\Models;

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
}
