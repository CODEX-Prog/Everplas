<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientGroup extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'created_by', 'updated_by'];

    /**
     * The table attribute.
     *
     * @var Table
     */
    protected $table = 'client_groups';

    /**
     * Get the company that owns the Contact.
     */
    public function company()
    {
        return $this->hasOne('App\Models\Company');
    }

    
}
