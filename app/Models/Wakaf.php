<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wakaf extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'target',
        'benefit',
        'expire_date',
        'image',
        'description',
        'link',
        // 'last_amount',
    ];

    public function donaturs(): HasMany
    {
        return $this->hasMany(Wakaf::class);
    }
}
