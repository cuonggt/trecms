<?php

namespace Cuonggt\Trecms;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

abstract class Post extends Model
{
    use Sluggable;

    public function author(): BelongsTo
    {
        return $this->belongsTo(Trecms::userModel(), 'user_id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }
}
