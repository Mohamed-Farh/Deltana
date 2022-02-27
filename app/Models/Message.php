<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Message extends Model
{

    use SearchableTrait;


    protected $guarded = [];

    protected $searchable = [
        'columns' => [
            'messages.name' => 10,
            'messages.mobile' => 10,
            'messages.speciality' => 10,
            'messages.address' => 10,
            'messages.note' => 10,
            'messages.status' => 10,
        ],
    ];

}
