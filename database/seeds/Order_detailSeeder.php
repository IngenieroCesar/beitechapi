<?php

use Illuminate\Database\Seeder;
use App\Order_detail;

class Order_detailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order_detail::Class, 5)->create();
    }
}
