<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
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
	DB::table('users')->insert([
		'name' => str_random(10),
		'email' => str_random(10).'@gmail.com',
		'password' => bcrypt('secret'),
		'created_at' => Carbon::now(),
	]);
	**/

	// Create three App\User instances...
	$users = factory(App\User::class, 10)->create();
    }
}
