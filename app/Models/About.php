<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class About extends Model
{
    protected $guarded = [];


    public function media(): MorphMany
    {
        return $this->MorphMany(Media::class, 'mediable');
    }

}
