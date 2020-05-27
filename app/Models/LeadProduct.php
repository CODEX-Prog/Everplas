<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadProduct extends Model
{
    /**
     * The table attribute.
     *
     * @var Table
     */
    protected $table = 'lead_products';

    /**
     *  Get the lead record associated with the lead product.
     */
    public function lead()
    {
        return $this->belongsTo('App\Models\Lead', 'lead_id');
    }
}
