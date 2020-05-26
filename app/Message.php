<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Redis;

class Message extends Model
{
    use Redis, Notifiable, SoftDeletes;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

//<th scope="col">CREATED</th>
//<th scope="col">MSISDN</th>
//<th scope="col">IN/OUT</th>
//<th scope="col">UPDATED</th>
//<th scope="col">MESSAGE</th>
//<th scope="col">STATUS</th>
//<th scope="col">ACTION</th>


    protected $fillable = [
        'direction',
        'lastname',
        'email',
        'password',
        'business_id',
        'msisdn',
        'active',
        'status',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'firstname' => 'string',
        'lastname' => 'string',
        'email_verified_at' => 'datetime',
        'business_id' => 'integer',
        'msisdn' => 'integer',
        'active' => 'boolean',
    ];
}
