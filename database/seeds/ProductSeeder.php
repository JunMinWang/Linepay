<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => '商品A',
            'description' => '這個是商品A',
            'price' => '11',
            'inventory' => '999',
            'img_name' => 'product_A'
        ]);

        DB::table('products')->insert([
            'name' => '商品B',
            'description' => '這個是商品B',
            'price' => '22',
            'inventory' => '3',
            'img_name' => 'product_A'
        ]);

        DB::table('products')->insert([
            'name' => '商品C',
            'description' => '這個是商品C',
            'price' => '33',
            'inventory' => '2',
            'img_name' => 'product_A'
        ]);


        DB::table('products')->insert([
            'name' => '商品D',
            'description' => '這個是商品D',
            'price' => '44',
            'inventory' => '0',
            'img_name' => 'product_A'
        ]);


        DB::table('products')->insert([
            'name' => '商品E',
            'description' => '這個是商品E',
            'price' => '55',
            'inventory' => '2',
            'img_name' => 'product_A'
        ]);
    }
}
