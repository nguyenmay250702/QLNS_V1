<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['nhân viên','quản lý'];
        for( $i = 0; $i < count($names); $i++ ){
            DB::table('roles')->insert([
                'name'=> $names[$i]
            ]);
        }   
    }
}
