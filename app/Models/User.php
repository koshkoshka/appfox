<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'email_verified_at' => 'datetime',
    ];

    public function companies(){
        return $this->belongsToMany(Company::class,'user_company')->using(UserCompany::class);
    }

    public function news(){
        return $this->belongsToMany(News::class,'user_news')->using(UserNews::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class,'user_product')->using(UserProduct::class);
    }

    public function subscriptions(){
        return $this->belongsToMany(Company::class,'user_company_subscription')->using(UserCompanySubscription::class)->withPivot(['subscribe_products','subscribe_news']);
    }
}
