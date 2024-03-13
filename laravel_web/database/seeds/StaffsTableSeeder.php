<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StaffsTableSeeder extends Seeder
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
            DB::table('staffs')->insert([
                'name'=> $faker->name(),
                'phone_number'=> $faker->phoneNumber(),
                'birthday'=>$faker->date('Y-m-d'),
                'address'=>$faker->address(),
                'gender'=>$faker->randomElement([0, 1]),
                'citizen_identity_card'=>$faker->numerify('############'),
                'department_id'=>$faker->numberBetween(1,5),
                'status'=>$faker->boolean(),
            ]);
        }
        
    }
}
