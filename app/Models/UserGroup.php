<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['group_name'];

    /**
     * The table attribute.
     *
     * @var Table
     */
    protected $table = 'user_groups';

    /**
     * Get the user for the groups.
     */
    public function user()
    {
        return $this->hasMany('App\User');
    }
}
