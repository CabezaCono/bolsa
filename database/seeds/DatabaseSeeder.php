<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $this->call(TeacherTableSeeder::class);
        $this->call(ProfesionalFamilyTableSeeder::class);
        $this->call(EnterprisesTableSeeder::class);
        //$this->call(EnterpriseTableSeeder::class);
        $this->call(OfferTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
        
    }
}
