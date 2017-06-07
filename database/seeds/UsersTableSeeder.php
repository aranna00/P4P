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
        ];
    
        $user = Sentinel::registerAndActivate($credentials);
    }
}
