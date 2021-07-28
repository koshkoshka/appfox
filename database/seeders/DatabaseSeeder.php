<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(3)->create();
        \App\Models\Company::factory(1)->create();
        $users=User::get();
        $company=Company::first();
        foreach($users as $key=>$user){
            if($key>0 && !empty($company)){
                $user->companies()->sync([$company->id]);
            }
        }
    }
}
