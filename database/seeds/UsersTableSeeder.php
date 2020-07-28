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
        //
        for($i = 1; $i <= 10;$i++)

        {
            DB::table('users')->insert(
                [
                    'name' => 'User_'.$i,
                    'email' => 'user_'.$i.'@mymail.com',
                    'password' => bcrypt('123456'),
                    'idComment' => rand(1,100),
                    'level'=> 0,
                    'quyen'=>0

                ]
            );
        }
    }
}
