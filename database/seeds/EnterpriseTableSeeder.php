<?php

use Illuminate\Database\Seeder;
use App\Enterprise;
use App\User;

class EnterpriseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user= new User;

        $user->name='El pozo';
        $user->email='Elpozofood@gmail.com';
        $user->password= '23243243';
        $user->phone='622092392';

        $user->save();

        $enterprise = new Enterprise();

        $enterprise->user_id= $user->id;
        $enterprise->descripcion ="";
        $enterprise->sociedad ="SL";
        $enterprise->cif = "83828282";
        $enterprise->fax = "968727272";
        $enterprise->fecha_fundacion ='1992/02/03';
        $enterprise->web ='www.elpozo.com';
        $enterprise->pais = 'España';
        $enterprise->ciudad = 'Alhama de Murcia';
        $enterprise->min_empleados = '50';
        $enterprise->max_empleados = '4000';

        $enterprise->save();
    }
}
