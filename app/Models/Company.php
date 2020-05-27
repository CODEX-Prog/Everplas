<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name', 'telephone', 'vat_number', 'fax', 'website', 'address', 'city', 'country', 'company_card'
    ];

    /**
     * The table attribute.
     *
     * @var Table
     */
    protected $table = 'companies';

    /**
     * Get the contacts of the company.
     */
    public function contacts()
    {
        return $this->hasMany('App\Models\Contact');
    }

    /**
     * Get the assets of the company.
     */
    public function assets()
    {
        return $this->hasMany('App\Models\Asset');
    }

    /**
     * Get the maintenances of the company.
     */
    public function maintenances()
    {
        return $this->hasMany('App\Models\Maintenance');
    }

    /**
     * Get the materials of the company.
     */
    public function materials()
    {
        return $this->hasMany('App\Models\Material');
    }

    /**
     * Get the job orders of the company.
     */
    public function jobOrders()
    {
        return $this->hasMany('App\Models\JobOrder');
    }

    /**
     * Get the leads of the company.
     */
    public function leads()
    {
        return $this->hasMany('App\Models\Lead');
    }

        /**
     * Get the group of the company.
     */

    public function group()
    {
        return $this->belongsTo('App\Models\ClientGroup');
    }

    
}
