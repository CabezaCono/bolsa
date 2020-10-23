<?php

use App\Family as ProfessionalFamily;
use Illuminate\Database\Seeder;

class ProfesionalFamilyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $familys = config("families");

        foreach ($familys as $familie){

            $family = new ProfessionalFamily(["name" => $familie["name"]]);
            $family->save();

            for ($i = 0; $i <= sizeof($familie["ciclos"])-1; $i++){
               $family->cicles()->create( $familie["ciclos"][$i])->save();
            }
        }
    }
}
