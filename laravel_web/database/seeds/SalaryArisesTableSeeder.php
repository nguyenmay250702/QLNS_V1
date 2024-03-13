<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SalaryArisesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('vi_VN');
        for ($i = 0; $i < 5; $i++) {
            DB::table('salary_arises')->insert([
                'staff_id'=>$faker->numberBetween(1,29),
                'fines_incentives_id'=>$faker->numberBetween(1,2),
            ]);
        }
    }
}
