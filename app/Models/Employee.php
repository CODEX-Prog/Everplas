<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
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
    protected $table = 'employees';

    /**
     * Get the Bank that owns the Employee.
     */
    public function bank()
    {
        return $this->belongsTo('App\Models\Bank');
    }

    /**
     * Get the Department that owns the Employee.
     */
    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'foreign_key');
    }

    /**
     * Get the assets of the Employee.
     */
    public function assets()
    {
        return $this->hasMany('App\Models\Asset', 'foreign_key');
    }

    /**
     * Get the Maintenances of the Employee.
     */
    public function maintenances()
    {
        return $this->hasMany('App\Models\Maintenance', 'mainten_employee_id');
    }

    /**
     * Get the assets of the Employee.
     */
    public function superMaintenances()
    {
        return $this->hasMany('App\Models\Maintenance', 'super_employee_id');
    }

    /**
     * Get the assets of the Employee.
     */
    public function reviewMaintenances()
    {
        return $this->hasMany('App\Models\Maintenance', 'review_employee_id');
    }

    /**
     * Get the job orders of the Employee.
     */
    public function jobOrders()
    {
        return $this->hasMany('App\Models\JobOrder');
    }

    /**
     * Get the leads of the employee.
     */
    public function leads()
    {
        return $this->hasMany('App\Models\Lead');
    }

    /**
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->hasOne('App\User', 'emp_id');
    }
}
