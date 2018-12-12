<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            PaymentTypeSeeder::class,
            OrderStatusSeeder::class,
            ProductSeeder::class,
            UserSeeder::class
        );
    }
}
