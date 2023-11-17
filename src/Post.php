<?php

namespace Cuonggt\Trecms;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

abstract class Post extends Model
{
    use Sluggable;

    public function author()
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
