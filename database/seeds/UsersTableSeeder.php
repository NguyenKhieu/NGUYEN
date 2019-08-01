<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // Let's clear the users table first
       User::truncate();

        DB::table('users')->truncate();
        $user = new User;
        $user->create([
            'name' => 'NguyenKhieu',
            'email' =>'khieuvannguyen97@gmail.com',
            'password' => bcrypt('A123456789'),
            'role' => 1,
        ]);


    }
}
