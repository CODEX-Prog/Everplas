<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
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
    protected $table = 'departments';

    /**
     * Get the employees of the department.
     */
    public function employees()
    {
        return $this->hasMany('App\Models\Employee');
    }
}
