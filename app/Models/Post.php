<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'subtitle', 'preview', 'text'];

    public function page()
    {
        return $this->morphOne(Page::class, 'pageable');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getEditLinkAttribute()
    {
        return route('cms.posts.edit', ['post' => $this->id]);
    }

    public function getShowLinkAttribute()
    {
        return route('cms.posts.show', ['post' => $this->id]);
    }

    // protected $appends = ['edit_link'];
}
