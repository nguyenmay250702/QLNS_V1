<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DepartmentsTableSeeder::class,
            RolesTableSeeder::class,
            PositionsTableSeeder::class,
            SalariesTableSeeder::class,
            StaffsTableSeeder::class,
            UsersTableSeeder::class,
            ContractsTableSeeder::class,
            TimekeepingsTableSeeder::class,
            DailyWorksTableSeeder::class,
            FinesIncentivesTableSeeder::class,
            SalaryArisesTableSeeder::class,
            SalaryDetailsTableSeeder::class
        ]);
    }
}
