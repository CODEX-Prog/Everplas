<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobOrder extends Model
{
    /**
     * The table attribute.
     *
     * @var Table
     */
    protected $table = 'job_orders';

    /**
     * Get the Company that owns the job orders.
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    /**
     * Get the Contact that owns the job orders.
     */
    public function contact()
    {
        return $this->belongsTo('App\Models\Contact', 'contact_id');
    }

    /**
     * Get the Employee that owns the job orders.
     */
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee', 'employee_id');
    }

    /**
     * The materials that belong to the product.
     */
    public function materials()
    {
        return $this->belongsToMany('App\Models\Material', 'job_material', 'job_id', 'material_id')
            ->withPivot('description', 'quantity', 'weight', 'amount');
    }
}
