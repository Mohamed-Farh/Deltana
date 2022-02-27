<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Career extends Model
{
    use SearchableTrait;

    protected $guarded = [];

    protected $searchable = [
        'columns' => [
            'careers.title' => 10,
            'careers.type' => 10,
            'careers.description' => 10,
            'careers.requirements' => 10,
        ],
    ];

}
