<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contact_name', 'contact_email', 'contact_telephone', 'contact_mobile', 'contact_job', 'contact_country', 'contact_business_card'
    ];

    /**
     * The table attribute.
     *
     * @var Table
     */
    protected $table = 'contacts';

    /**
     * Get the company that owns the Contact.
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }
    // foreign_key

    /**
     * Get the assets of the contact.
     */
    public function assets()
    {
        return $this->hasMany('App\Models\Asset');
    }

    /**
     * Get the materials of the contact.
     */
    public function materials()
    {
        return $this->hasMany('App\Models\Material');
    }

    /**
     * Get the job orders of the contact.
     */
    public function jobOrders()
    {
        return $this->hasMany('App\Models\JobOrder');
    }

    /**
     * Get the leads of the contact.
     */
    public function leads()
    {
        return $this->hasMany('App\Models\Lead');
    }

    
    /**
     * Get the Client group that owns the Contact.
     */
    public function group()
    {
        return $this->belongsTo('App\Models\ClientGroup');
    }

}
