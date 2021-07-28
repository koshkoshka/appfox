<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserCompany extends Pivot
{
    public static function boot() {
        parent::boot();

        static::created(function (UserCompany $item) {
            /** @var User $user */
            $user=$item->user;
            $user->subscriptions()->syncWithoutDetaching([
                $item->company_id=>[
                    'subscribe_products'=>1,
                    'subscribe_news'=>1,
                ]
            ]);
        });
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function company(){
        return $this->belongsTo(Company::class,'user_id');
    }
}
