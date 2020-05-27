<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{

    /**
     * The table attribute.
     *
     * @var Table
     */
    protected $table = 'sales';
        /**
     *  Get the company record associated with the lead.
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    /**
     *  Get the contact record associated with the lead.
     */
    public function contact()
    {
        return $this->belongsTo('App\Models\Contact', 'contact_id');
    }

    /**
     *  Get the employee record associated with the lead.
     */
    public function employee()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    // /**
    //  * Get the products of the lead.
    //  */
    // public function products()
    // {

    //     return $this->hasMany('App\Models\LeadProduct');
    // }


    // public static function getLeadsClosed() { 
    //     return static::where('status','Declined')->get();
    // }


            /**
     * Get the leads of the product.
     */
    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'products_sale')->withPivot('prod_name', 'description', 'qty', 'rate', 'vat', 'amount');
    }
}
