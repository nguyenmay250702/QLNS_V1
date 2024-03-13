<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SalariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create('vi_VN');
        for ($i = 0; $i < 5; $i++) {
            DB::table('salaries')->insert([
                'basic_salary'=>$faker->numberBetween(8000000,50000000),
            ]);
        }
    }
}
