<?php

use Illuminate\Database\Seeder;
use App\Order;
use App\Order_detail;
use App\Product_user;
use App\Product;
use App\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(Product::Class, 10)->create();
        $this->call(UserSeeder::class);
        factory(Order::Class, 30)->create();
        factory(Order_detail::Class, 60)->create();    
                
    }

}
