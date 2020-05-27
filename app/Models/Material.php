<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    /**
     * The table attribute.
     *
     * @var Table
     */
    protected $table = 'materials';

    /**
     * Get the Company that owns the Material.
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    /**
     * Get the Contact that owns the Material.
     */
    public function contact()
    {
        return $this->belongsTo('App\Models\Contact', 'contact_id');
    }

    /**
     * The products that belong to the material.
     */
    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'material_product', 'material_id', 'product_id');
    }

    /**
     * The job orders that belong to the material.
     */
    public function jobs()
    {
        return $this->belongsToMany('App\Models\JobOrder', 'job_material', 'material_id', 'job_id');
    }
}
