<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function ratings () {
        return $this->hasMany(Ratings::class, 'user_id');
    }

    public function reviews ()
    {
        return $this->hasMany(Reviews::class, 'to_user_id')->latest();
    }

    public function services(){
        return $this->hasMany( UserServices::class, 'user_id');
    }

    public function experiences(){
        return $this->hasMany(UserExperience::class, 'user_id');
    }

    public function degree(){
        return $this->hasOne(UserQualification::class, 'user_id');
    }

    public function portfolio(){
        return $this->hasOne(UserPortfolio::class, 'user_id');
    }

    public function bid(){
        return $this->belongsTo(Bids::class, 'user_id');
    }

    public function wallet(){
        return $this->hasOne(Wallet::class, 'user_id');
    }

    public function payments(){
        return $this->hasMany(Payments::class, 'user_id');
    }
 }
