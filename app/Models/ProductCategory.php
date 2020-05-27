<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
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
    protected $table = 'product_categories';

    /**
     * Get the products of the Category.
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
