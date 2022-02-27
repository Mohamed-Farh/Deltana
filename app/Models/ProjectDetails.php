<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Nicolaslopezj\Searchable\SearchableTrait;

class ProjectDetails extends Model
{
    use SearchableTrait;


    protected $guarded = [];

    protected $searchable = [
        'columns' => [
            'project_details.title' => 10,
            'project_details.category' => 10,
            'project_details.text' => 10,
            'project_details.technology' => 10,
            'project_details.link' => 10,
            'project_details.top' => 10,
            'project_details.status' => 10,
        ],
    ];

    public function media(): MorphMany
    {
        return $this->MorphMany(Media::class, 'mediable');
    }

}
