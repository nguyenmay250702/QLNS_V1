<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SalaryDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('vi_VN');
        for ($i = 0; $i < 30; $i++) {
            DB::table('salary_details')->insert([
                'staff_id'=> $faker->numberBetween(1,10),
                'contract_id'=> $faker->numberBetween(1,10),
                'pay_date'=>$faker->date('Y-m-d'),
                'overtime'=>$faker->numberBetween(1,60),
                'late_arrival_date'=>$faker->numberBetween(1,30),
                'unpaid_leave_days'=>$faker->numberBetween(1,30),
                'late_penalty_per_day'=>$faker->randomElement([50,70]),
                'total_salary'=>$faker->randomFloat(2,5000000,20000000),
            ]);
        }
    }
}
