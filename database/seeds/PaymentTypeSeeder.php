<?php

use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('paymentType')->insert([
            'type' => '現金'
        ]);
        DB::table('paymentType')->insert([
            'type' => 'Linepay'
        ]);
        DB::table('paymentType')->insert([
            'type' => '信用卡'
        ]);
    }
}
