<?php

use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orderStatus')->insert([
            'status' => '處理中'
        ]);
        DB::table('orderStatus')->insert([
            'status' => '待付款'
        ]);
        DB::table('orderStatus')->insert([
            'status' => '已付款'
        ]);
        DB::table('orderStatus')->insert([
            'status' => '付款成功'
        ]);
        DB::table('orderStatus')->insert([
            'status' => '已取消'
        ]);
        DB::table('orderStatus')->insert([
            'status' => '付款失敗'
        ]);
        DB::table('orderStatus')->insert([
            'status' => '申請退貨'
        ]);
        DB::table('orderStatus')->insert([
            'status' => '待退款'
        ]);
        DB::table('orderStatus')->insert([
            'status' => '退貨完成'
        ]);
    }
}
