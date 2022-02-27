<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Technology extends Model
{

    use SearchableTrait;

    protected $guarded = [];


    protected $searchable = [
        'columns' => [
            'technologies.name' => 10,
        ],
    ];

}
