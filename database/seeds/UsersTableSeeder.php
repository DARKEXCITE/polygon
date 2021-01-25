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
        $users = [
            [
                'name'              => 'Неизвестно',
                'email'             => 'unknown@unknown.email',
                'email_verified_at' => now(),
                'password'          => bcrypt(Str::random(16)),
                'remember_token'    => Str::random(10),
                'created_at'        => now(),
                'updated_at'        => now()
            ],
            [
                'name'              => 'Автор',
                'email'             => 'author@author.email',
                'email_verified_at' => now(),
                'password'          => bcrypt('0000'),
                'remember_token'    => Str::random(10),
                'created_at'        => now(),
                'updated_at'        => now()
            ]
        ];

        \DB::table('users')->insert($users);
    }
}
