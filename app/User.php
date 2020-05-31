<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'full_name',
        'user_view_permission', 'user_delete_permission', 'user_update_permission', 'user_create_permission',
        'crm_view_permission', 'crm_delete_permission', 'crm_update_permission', 'crm_create_permission',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get the  record associated with the user.
     */
    public function CompnayInformation()
    {
        return $this->hasOne('App\Models\CompanyInfo', 'foreign_key');
    }


    /**
     * Get the  record associated with the user.
     */
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee');
    }
    
    
}
