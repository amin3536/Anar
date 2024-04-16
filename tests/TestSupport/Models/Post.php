<?php

namespace amin3520\Anar\Tests\TestSupport\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use amin3520\Anar\Tests\TestSupport\database\factories\PostFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'text', 'status', 'is_published'];

    /**
     * {@inheritDoc}
     */
    protected static function newFactory(): PostFactory
    {
        return PostFactory::new();
    }
}
