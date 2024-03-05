<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Donatur extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'phone',
        'wakaf_id'
    ];


    public function wakafs(): BelongsToMany
    {
        return $this->belongsToMany(Wakaf::class, "wakafs", "wakaf_id", "id");
    }
}
