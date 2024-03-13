<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TimekeepingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 100; $i++) {
            DB::table("timekeepings")->insert([
                'start_time'=>$faker->dateTime('Y-m-d H:i:s'),
                'end_time'=>$faker->dateTime('Y-m-d H:i:s'),
                'staff_id'=>$faker->numberBetween(1,30)
            ]);
        }
    }
}
