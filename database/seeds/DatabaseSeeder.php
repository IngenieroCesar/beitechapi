<?php

use Illuminate\Database\Seeder;
use App\Order;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //llamamos nuestros seeders creados para precargas datos fake
        $this->call(UserSeeder::class);
        $this->call(ProductsSeeder::class);
        factory(Order::Class, 5)->create();
    }
}
