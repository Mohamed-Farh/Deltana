<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class ContactMessage extends Model
{

    use SearchableTrait;

    protected $table = 'contact_messages';

    protected $searchable = [
        'columns' => [
            'contact_messages.full_name' => 10,
            'contact_messages.country' => 10,
            'contact_messages.company' => 10,
            'contact_messages.mobile' => 10,
            'contact_messages.status' => 10,
        ],
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'company','country', 'mobile', 'note', 'status', 'created_at', 'updated_at'
    ];




    public $timestamps = true;

}
