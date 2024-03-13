<?php

use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Giám đốc', 'Phó giám đốc', 'Nhân viên kế toán', 'Kế toán trưởng', 'Lễ tân',
        'Tester', 'Fresher tester', 'Thực tập sinh tester',
        'BA', 'Fresher BA', 'Thực tập sinh BA',
        'Lập trình android', 'Fresher android', 'Thực tập sinh android',
        'Lập trình .NET', 'Fresher .NET', 'Thực tập sinh .NET',
        'Marketing', 'Thực tập sinh marketing',
        'Sales', 'Thực tập sinh sales'];

        for( $i = 0; $i < count($names); $i++ ){
            DB::table('positions')->insert([
                'name'=> $names[$i],
                'status'=> 1
            ]);
        } 
    }
}
