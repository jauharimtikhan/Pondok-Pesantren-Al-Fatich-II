<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Posts extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'id',
        'title',
        'content',
        'user_id',
        'slug',
        'meta_description',
        'category_id',
        'is_published',
        'is_featured',
    ];

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
