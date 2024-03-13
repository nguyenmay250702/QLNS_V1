<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for( $i = 0; $i < 10; $i++ ) {
            DB::table('users')->insert([
                'username'=> $faker->userName(),
                'password'=> Hash::make(250702),
                'role_id'=> $faker->randomElement([1,2]),
                'staff_id'=> $faker->numberBetween(1,30),
                'status'=> $faker->numberBetween(0,1),
            ] );
        }
    }
}
