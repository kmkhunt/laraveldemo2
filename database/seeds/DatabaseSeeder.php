<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run() {
		for ($i = 1; $i <= 100; $i++) {
			DB::table('users')->insert([
				'name' => Str::random(8),
				'email' => Str::random(12) . '@mail.com',
				'password' => bcrypt('123456'),
			]);
		}
	}
}
