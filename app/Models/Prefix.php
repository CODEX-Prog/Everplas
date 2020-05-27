<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prefix extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice', 'quotation', 'estimation', 'po', 'joborder', 'receipt', 'credit_note',
        'receiving', 'employee', 'accenting', 'bank', 'transaction', 'purchase'
    ];

    /**
     * The table attribute.
     *
     * @var Table
     */
    protected $table = 'prefixes';
}
