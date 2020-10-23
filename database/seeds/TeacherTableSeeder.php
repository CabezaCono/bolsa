<?php

use App\Teacher;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class TeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // CREACION DEL USUARIO ADMIN

        $user_opts = [
            "email" => "cmabris@gmail.com",
            "password" => "123456",
            "name" => 'Carlos',
            "phone" => '667584212',
            "is_active" => 1
        ];

        $user = new User($user_opts);
        $user->save();

        $teacher_opts = [

            "apellidos" => 'Abrisqueta Valcárcel',
            "nrp_expediente" => '2748583568A',
            "is_admin" => true,

        ];
        $user->teacher()->create($teacher_opts);
    }
}
