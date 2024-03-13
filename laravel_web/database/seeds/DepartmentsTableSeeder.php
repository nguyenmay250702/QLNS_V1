<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker = Faker::create('vi_VN');
        $names = ['Phòng kinh doanh','Phòng IT','Phòng kế toán','Phòng sản phẩm','Phòng Marketing'];
        $address = ['khoang 1, phòng P1, tầng 1','khoang 2, phòng P1, Tầng 1','khoang 1, phòng P2, tầng 2','khoang 2, phòng P2, tầng 2','khoang 1, phòng P1, tầng 3'];
        for( $i = 0; $i < count($names); $i++ ){
            DB::table('departments')->insert([
                'name'=> $names[$i],
                'address'=> $address[$i],
                'status'=> 1,
            ]);
        }   
    }
}
