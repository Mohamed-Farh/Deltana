<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Apply extends Model
{
    use SearchableTrait;

    protected $guarded = [];

    protected $searchable = [
        'columns' => [
            'applies.first_name' => 10,
            'applies.last_name' => 10,
            'applies.email' => 10,
            'applies.mobile' => 10,
        ],
    ];

}
