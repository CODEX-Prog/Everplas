<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The table attribute.
     *
     * @var Table
     */
    protected $table = 'banks';

    /**
     * Get the employees of the Bank.
     */
    public function employees()
    {
        return $this->hasMany('App\Models\Employee');
    }
}
