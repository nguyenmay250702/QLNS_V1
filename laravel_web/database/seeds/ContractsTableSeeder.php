<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ContractsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for( $i = 0; $i < 20; $i++ ){
            DB::table("contracts")->insert([
                'start_date'=>$faker->date('Y-m-d'),
                'end_date'=>$faker->date('Y-m-d'),
                'status'=>$faker->randomElement([0,1]),
                'staff_id'=>$faker->numberBetween(1,30),
                'position_id'=>$faker->numberBetween(1,20),
                'salary_id'=>$faker->numberBetween(1,5)
            ]);
        }
    }
}
