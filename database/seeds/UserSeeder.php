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
        //Insersión SQL
        DB::table('users')->insert([
            'name'      =>    'beitech',
            'email'     =>    'beitech@test.com',
            'email_verified_at' => now(),
            'password'  =>    bcrypt('12345'),  
          ]);

        //generamos a nuestro usuario u genera un relación con productos
        $users = factory(App\User::Class, 15)->create()->each(function($user){
            //Este metodo lo usamos para que genere la relación muchos a muchos entre estas dos tablas
            $user->products()->attach($this->array(rand(1,30)));
        });
    }

        //Generamos el metodo array()
        public function array($max){

            $values = [];
            for ($i=1; $i < $max ; $i++) { 
            $values[] = $i;
            }
    
            return $values;
        }
}
