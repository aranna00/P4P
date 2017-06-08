<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $credentials = [
            'email'    => 'admin@admin.admin',
            'password' => 'admin',
            "first_name"=>"admin",
            "last_name"=>"admin",
            "business_id"=>1
        ];
    
        $user = Sentinel::registerAndActivate($credentials);
    }
}
