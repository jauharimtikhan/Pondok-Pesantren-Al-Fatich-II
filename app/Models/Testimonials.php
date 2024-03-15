<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Testimonials extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'id', 'name', 'wakaf_id', 'quotes'
    ];

    public function wakaf(): BelongsTo
    {
        return $this->belongsTo(Wakaf::class);
    }
}
