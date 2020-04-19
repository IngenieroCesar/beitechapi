<?php

use Illuminate\Database\Seeder;
use App\Order;
use App\Order_detail;
use App\Product_user;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        // llamamos nuestros seeders creados para precargas datos fake
        $this->call(UserSeeder::class);
        $this->call(ProductSeeder::class);
        factory(Order::Class, 10)->create();
        factory(Order_detail::Class, 5)->create();        
        
    }
}
