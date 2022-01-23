<?php

namespace App\Models;

use Error;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'header_1',
        'og_type',
        'og_title',
        'og_image',
        'og_description',
        'twitter_card',
        'twitter_site',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'cover_id',
        'show_in_menu',
        'slug',
        'approved_at',
        'expires_at',
    ];

    public function pageable()
    {
        return $this->morphTo();
    }

    public function setSlugAttribute($value)
    {
        if(!$value) throw new \Exception('slug can\'t be null');
        $value = strval($value);
        $value = strtolower($value);
        $value = preg_replace('/[^a-z0-9à-ẑ]/', '-', $value);
        $value = preg_replace('/[-]{2,}/', '-', $value);
        $value = preg_replace('/^-|-$/', '', $value);
        $this->attributes['slug'] = $value;
    }

    public function setOgTypeAttribute($value)
    {
        $accepted = ['website', 'article'];
        $this->attributes['og_type'] = in_array($value, $accepted) ? $value : $accepted[0];
    }

    public function setTwitterCardAttribute($value)
    {
        $accepted = ['summary', 'summary_large_image', 'app', 'player'];
        $this->attributes['twitter_card'] = in_array($value, $accepted) ? $value : $accepted[0];
    }

    public function setShowInMenuAttribute($value)
    {
        $this->attributes['show_in_menu'] = isset($value) && $value ? true : false;
    }
}
