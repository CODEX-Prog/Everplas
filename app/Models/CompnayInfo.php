<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompnayInfo extends Model
{
    protected $table = 'company_information';


    /**
     * Get the phone record associated with the user.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
