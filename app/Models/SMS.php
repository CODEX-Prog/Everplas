<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SMS extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'api_url', 'username', 'password'
    ];

    /**
     * The table attribute.
     *
     * @var Table
     */
    protected $table = 'sms';
}
