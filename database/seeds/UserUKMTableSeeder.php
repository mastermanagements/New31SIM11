<?php

use Illuminate\Database\Seeder;

class UserUKMTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //metode factory
		factory(App\Model\Superadmin_ukm\U_user_ukm::class, 3)->create()->each(function($user_ukm){
			$user_ukm->posts()->save(factory(App\Post::class)->make());
		});
		
    }
}
