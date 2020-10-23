<?php

use App\User;
use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    public function run() {
        $faker = Faker\Factory::create("es_ES");

        // CREACION DEL USUARIO ALUMNO
            $user_opts = [
                "email" => "student@gmail.com",
                "password" => "123456",
                "phone" => "6" . $faker->randomNumber(8),
                "name" => $faker->firstName,
                "is_active" => 1
            ];
            $user = new User($user_opts);
            $user->save();

            $student_opts = [
                'apellidos'  =>  $faker->lastName,
                'nre'   =>  $faker->randomNumber(9),
                'vehiculo'   => $faker->boolean,
                'domicilio' =>  $faker->country . ", " . $faker->city . ", Nº " . $faker->randomNumber(3),
                'status' => $faker->randomElement(['ESTUDIANDO', 'FCT', 'CONTRATADO', 'PARO']),
                'edad' => $faker->randomNumber(2)

            ];

            $user->student()->create($student_opts);
    }
}

