<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->user();
	}

	private function user()
	{
		User::factory(10)->create();
		$data = [
			[
				'name' => 'Admin',
				'email' => 'admin@app.com',
				'user_type' => '1',
				'password' => Hash::make('password'),
				'email_verified_at' => now(),
			],
			[
                'name' => 'User',
                'email' => 'user2@app.com',
                'user_type' => '0', 
				'password' => Hash::make('password'),  
				'email_verified_at' => now(),
            ],
		];
		foreach ($data as $item) {
			User::updateOrCreate($item);
		}
	}
}
