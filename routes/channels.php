<?php

use App\Models\Company;
use App\Models\News;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('news.created.{company_id}',function ($user, $company_id){
    $company=Company::find($company_id);
    if(empty($company) || empty($user))return false;
    return $company->users->pluck('id')->contains($user->id);
});

Broadcast::channel('product.created.{company_id}',function ($user, $company_id){
    $company=Company::find($company_id);
    if(empty($company) || empty($user))return false;
    return $company->users->pluck('id')->contains($user->id);
});
