<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostMedia extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'id', 'post_id', 'path'
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Posts::class);
    }
}
