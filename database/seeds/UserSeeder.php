<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'      =>    'beitech',
            'email'     =>    'beitech@test.com',
            'password'  =>    bcrypt('12345'),  
          ]);
          
        factory(User::Class, 5)->create();
    }
}
