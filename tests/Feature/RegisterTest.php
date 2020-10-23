<?php

namespace Tests\Feature;

use Faker\Factory as Faker;
use Carbon\Carbon;
use Tests\BrowserKitTestCase as TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegisterTest extends TestCase
{


	use DatabaseTransactions;
    

    /**
     * @todo Intenta crear un nuevo Alumno
     *
     * @return void
     */
    public function test_can_create_a_new_student()
    {
        //Having
        $faker =  Faker::create('es_ES');
            $student_opts = [
                "email" => $faker->email,
                "name" => "Carlos",
                "apellidos" => "Abrisqueta",
                "password" => "123456",
                "password_confirmation" => "123456",
                "phone" => "96800456",
                'nre'   => "3206891",
                'vehiculo'   => true,
                'domicilio' =>  "Calle Atapuerca N1",
                'status' => "ESTUDIANDO",
                'edad' => "19"
            ];

        //When

        $this->visit(route('register.student'))
            ->type($student_opts["email"],"email")
            ->type($student_opts["name"],"name")
            ->type($student_opts["apellidos"],"apellidos")
            ->type($student_opts["password"],"password")
            ->type($student_opts["password_confirmation"],"password_confirmation")
            ->type($student_opts["phone"],"phone")
            ->type($student_opts["nre"],"nre")
            ->type($student_opts["vehiculo"],"vehiculo")
            ->type($student_opts["domicilio"],"domicilio")
            ->select($student_opts["status"],"status")
            ->type($student_opts["edad"],"edad")
            ->press("Crear Cuenta");

        //Then
        $this->seeInDatabase('users',["email" => $student_opts["email"],"name" => $student_opts["name"],"phone" => $student_opts["phone"],"is_active" => 0])
             ->seeInDatabase("students",["apellidos" => $student_opts["apellidos"],"nre" => $student_opts["nre"]]);
    }


    public function test_can_create_a_new_enterprise()
    {
        //Having
        $faker =  Faker::create('es_ES');
        $enterprise_opts = [
            "email" => $faker->email,
            "name" => "Carlos",
            "password" => "123456",
            "password_confirmation" => "123456",
            "phone" => "96800456",
            'cif'   => "3206891",
            'pais' =>  "España",
            'ciudad' => "Murcia",
            'sociedad' => "SL",
            "score" => $faker->numberBetween(1,10)
        ];

        //When

        $this->visit(route('register.enterprise'))
            ->type($enterprise_opts["email"],"email")
            ->type($enterprise_opts["name"],"name")
            ->type($enterprise_opts["password"],"password")
            ->type($enterprise_opts["password_confirmation"],"password_confirmation")
            ->type($enterprise_opts["phone"],"phone")
            ->type($enterprise_opts["cif"],"cif")
            ->type($enterprise_opts["pais"],"pais")
            ->type($enterprise_opts["ciudad"],"ciudad")
            ->select($enterprise_opts["sociedad"],"sociedad")
            ->press("Crear Cuenta");

        //Then
        $this->seeInDatabase('users',["email" => $enterprise_opts["email"],"name" => $enterprise_opts["name"],"phone" => $enterprise_opts["phone"],"is_active" => 0])
            ->seeInDatabase("enterprises",["sociedad" => $enterprise_opts["sociedad"],"cif" => $enterprise_opts["cif"]]);
    }

    public function test_can_create_a_new_teacher()
    {
        //Having
        $email =  Faker::create('es_ES')->email;
        $date = Carbon::now('UTC')->addDays(1);
        $teacher_opts = [
            "code" => \Doorman::generate()->for($email)->expiresOn($date)->make()[0]->code,
            "email" => $email,
            "name" => "Carlos",
            "apellidos" => "Abrisqueta",
            "password" => "123456",
            "password_confirmation" => "123456",
            "phone" => "96800456",
            'nrp_expediente'   => "3206891",
        ];
        //When

        $this->visit(route('register.teacher'))
            ->type($teacher_opts["code"],"code")
            ->type($teacher_opts["email"],"email")
            ->type($teacher_opts["name"],"name")
            ->type($teacher_opts["apellidos"],"apellidos")
            ->type($teacher_opts["password"],"password")
            ->type($teacher_opts["password_confirmation"],"password_confirmation")
            ->type($teacher_opts["phone"],"phone")
            ->type($teacher_opts["nrp_expediente"],"nrp_expediente")
            ->press("Crear Cuenta");

        //Then
        $this->seeInDatabase('users',["email" => $teacher_opts["email"],"name" => $teacher_opts["name"],"phone" => $teacher_opts["phone"],"is_active" => 0])
             ->seeInDatabase("teachers",["nrp_expediente" => $teacher_opts["nrp_expediente"],"apellidos" => $teacher_opts["apellidos"]]);
    }


    public function test_cannot_create_a_new_teacher_without_key()
    {
        //Having
        $email =  Faker::create('es_ES')->email;
        $teacher_opts = [
            "email" => $email,
            "name" => "Carlos",
            "apellidos" => "Abrisqueta",
            "password" => "123456",
            "password_confirmation" => "123456",
            "phone" => "96800456",
            'nrp_expediente'   => "3206891",
        ];

        //When
        $this->visit(route('register.teacher'))
            ->type($teacher_opts["email"],"email")
            ->type($teacher_opts["name"],"name")
            ->type($teacher_opts["apellidos"],"apellidos")
            ->type($teacher_opts["password"],"password")
            ->type($teacher_opts["password_confirmation"],"password_confirmation")
            ->type($teacher_opts["phone"],"phone")
            ->type($teacher_opts["nrp_expediente"],"nrp_expediente")
            ->press("Crear Cuenta");

        //Then
        $this->seePageIs(route('register.teacher'));
        $this->notSeeInDatabase('users',["email" => $teacher_opts["email"],"name" => $teacher_opts["name"],"phone" => $teacher_opts["phone"],"is_active" => 0])
            ->notSeeInDatabase("teachers",["nrp_expediente" => $teacher_opts["nrp_expediente"],"apellidos" => $teacher_opts["apellidos"]]);
    }

}
