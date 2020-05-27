<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The table attribute.
     *
     * @var Table
     */
    protected $table = 'products';

    /**
     * The materials that belong to the product.
     */
    public function materials()
    {
        return $this->belongsToMany('App\Models\Material', 'material_product', 'product_id', 'material_id');
    }

    /**
     * Get the category that owns the Product.
     */
    public function category()
    {
        return $this->belongsTo('App\Models\ProductCategory', 'category_id');
    }

        /**
     * Get the leads of the product.
     */
    public function leads()
    {
        return $this->belongsToMany('App\Models\Lead', 'lead_products')->withPivot('prod_name', 'description', 'qty', 'rate', 'vat', 'amount');
    }

     /**
     * Get the leads of the product.
     */
    public function sales()
    {
        return $this->belongsToMany('App\Models\Sale', 'products_sale')->withPivot('prod_name', 'description', 'qty', 'rate', 'vat', 'amount');
    }
}
