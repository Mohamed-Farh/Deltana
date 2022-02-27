<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactService extends Model
{

    protected $table = 'contact_services';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message_id', 'service', 'created_at', 'updated_at'
    ];


    public $timestamps = true;

}
