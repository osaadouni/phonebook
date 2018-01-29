<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
	/** 
	DB::table('products')->insert([
		'name' => str_random(10),
		'price' => mt_rand(10, 299),
		'created_at' => Carbon::now(),
	]);
	*/

	 // Create three App\User instances...
    	$products = factory(App\Product::class, 10)->create();
	
    }
}
