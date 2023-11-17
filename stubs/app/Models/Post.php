<?php

namespace App\Models;

use Cuonggt\Trecms\Post as TrecmsPost;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends TrecmsPost
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>|bool
     */
    protected $guarded = [];
}
