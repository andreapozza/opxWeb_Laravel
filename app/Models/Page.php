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
        /**
        * if(!value) return '';
        * return value.toString()
        * .toLowerCase()
        * .replace(/[^a-z0-9À-ẑ]/g, '-')
        * .replace(/[-]{2,}/g, '-')
        * .replace(/^-|-$/g, '')
        */
        if(!$value) throw new \Exception('slug can\'t be null');
        $value = strval($value);
        $value = strtolower($value);
        $value = preg_replace('/[^a-z0-9à-ẑ]/', '-', $value);
        $value = preg_replace('/[-]{2,}/', '-', $value);
        $value = preg_replace('/^-|-$/', '', $value);
        $this->attributes['slug'] = $value;
    }
}
