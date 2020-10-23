<?php

use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EnterprisesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create("es_ES");

        // CREACION DEL USUARIO EMPRESA
        $user_opts = [
                "email" => "enterprise@gmail.com",
                "password" => "123456",
                "name" => $faker->company,
                "phone" =>  $faker->randomNumber(9),
                "is_active" => 1
            ];

            $user = new User($user_opts);
            $user->save();

            $enterprise_opts = [
                "descripcion" =>$faker->text(200),
                "sociedad" => $faker->randomElement(["SL","SA","SAE","SLNE","AUT"]),
                "cif" => $faker->randomNumber(9),
                "fax" =>  $faker->randomNumber(9),
                "fecha_fundacion" => '1992/02/03',
                "web" => $faker->url,
                "pais" => 'España',
                "ciudad" => 'Alhama de Murcia',
                "min_empleados" => $faker->randomNumber(2),
                "max_empleados" => $faker->randomNumber(4)
            ];

            $user->enterprise()->create($enterprise_opts);
    }
}
