<?php

use Illuminate\Database\Seeder;

class UserstableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([

'name'=>'admin',
'avatar'=>'uploads/profile/avatar.png',
'password'=>bcrypt('admin'),
'email'=>'admin@admin.com',
'admin'=>1
        ]);

    }
}
