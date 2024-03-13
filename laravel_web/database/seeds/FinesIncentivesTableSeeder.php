<?php

use Illuminate\Database\Seeder;

class FinesIncentivesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            ['name'=>'thời gian bắt đầu làm', 'value'=>'8:30'],
            ['name'=>'thời gian kết thúc làm', 'value'=>'5:30'],
            ['name'=>'đi muộn 1 phút', 'value'=>'5000'],
            ['name'=>'tiền OT', 'value'=>'400000'],];

        foreach ($list as $item) {
            DB::table('fines_incentives')->insert([
                'name'=> $item['name'],
                'value'=> $item['value'],
            ] );
        }
    }
}
