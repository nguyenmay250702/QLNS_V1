<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DailyWorksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            DB::table("daily_works")->insert([
                'content'=>$faker->text(),
                'result'=>$faker->text(),
                'start_time'=>$faker->dateTime('Y-m-d H:m:s'),
                'end_time'=>$faker->dateTime('Y-m-d H:m:s'),
                'status'=>$faker->randomElement([0,1]),
                'staff_id'=>$faker->numberBetween(1,30)
            ]);
        }
    }
}
