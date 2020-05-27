<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    /**
     * The table attribute.
     *
     * @var Table
     */
    protected $table = 'maintenances';

    /**
     * Get the Asset that owns the Maintenance.
     */
    public function asset()
    {
        return $this->belongsTo('App\Models\Asset', 'asset_id');
    }

    /**
     * Get the Company that owns the Maintenance.
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    /**
     * Get the maintenance Employee that owns the Maintenance.
     */
    public function maintenEmployee()
    {
        return $this->belongsTo('App\Models\Employee', 'mainten_employee_id');
    }

    /**
     * Get the super Employee that owns the Maintenance.
     */
    public function superEmployee()
    {
        return $this->belongsTo('App\Models\Employee', 'super_employee_id');
    }

    /**
     * Get the review Employee that owns the Maintenance.
     */
    public function reviewEmployee()
    {
        return $this->belongsTo('App\Models\Employee', 'review_employee_id');
    }
}
