<?php

use Illuminate\Database\Seeder;
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
        App\User::insert([
        	[
        		'name' => 'Bruce Wayn',
        		'avatar' => 'empty',
        		'email' => 'brucewayn@gmail.com',
        		'password' => bcrypt('password'),
        		'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        		'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        	],

        	[
				'name' => 'Peter Parker',
				'avatar' => 'empty',
        		'email' => 'peterpark@gmail.com',
        		'password' => bcrypt('password'),
        		'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        		'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        	]
        ]);
    }
}
