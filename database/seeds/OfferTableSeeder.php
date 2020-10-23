<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use App\Offer;
use App\Family;
use App\Enterprise;

class OfferTableSeeder extends Seeder

{

    public function run()

    {

        $professionalFamilies = Family::count();
        $enterprise = Enterprise::count();

        $faker = Faker::create("es_ES");

            $offer_opts = [
                "enterprise_id" => 1,
                "requirements" => $faker->paragraph(),
                "recommended" => $faker->paragraph(),
                "description" => $faker->paragraph(),
                "title" => $faker->text(255),
                "work_day" => $faker->randomElement(['full day', 'half day']),
                "schedule" => $faker->randomNumber(2),
                "contract" => $faker->randomElement(['FCT', 'Practice', 'Temporay', 'Indefinite']),
                "salary" => $faker->randomNumber(4),
                "status" => $faker->randomElement(['Pend_Validacion', 'Pend_Confirmacion', 'Pausada', 'Finalizada', 'Denegada']),
                "student_number" => $faker->randomNumber(2),
                "start_date" => $faker->date(),
                "end_date" => $faker->date(),
                "family_id" => rand(1, $professionalFamilies),
            ];

            $offer = new Offer($offer_opts);
            $offer->save();

    }

}

