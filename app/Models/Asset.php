<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    /**
     * The table attribute.
     *
     * @var Table
     */
    protected $table = 'assets';

    /**
     * Get the Company that owns the Asset.
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    /**
     * Get the Contact that owns the Asset.
     */
    public function contact()
    {
        return $this->belongsTo('App\Models\Contact');
    }

    /**
     * Get the Employee that owns the Asset.
     */
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee');
    }

    /**
     * Get the maintenances of the Asset.
     */
    public function maintenances()
    {
        return $this->hasMany('App\Models\Maintenance');
    }
}
