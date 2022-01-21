<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['slug'];

    public function pageable()
    {
        return $this->morphTo();
    }

    public function uri()
    {
        $slug = $this->slug;

        return $slug;
    }
}
