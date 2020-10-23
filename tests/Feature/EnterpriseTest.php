<?php

namespace Tests\Feature;

/** REQUEST */


/** MODELOS */
use App\Cicle;
use App\Enterprise;
use App\Family;
use App\Teacher;
use App\Student;

/** MAILS */
use Illuminate\Support\Facades\Mail;

/** OTROS */
use Faker\Factory as Faker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EnterpriseTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Prueba si puedo crear una empresa logueado como administrador.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_admin_can_create_a_enterprise()
    {

        //Having
        $faker =  Faker::create('es_ES');
        $pass = $faker->password();
        $enterprise_opts = [
            "email" => $faker->email,
            "name" => $faker->company,
            "password" => $pass,
            "password_confirmation" => $pass,
            "phone" => $faker->randomNumber(9),
            'cif'   => $faker->randomNumber(9),
            'fax'   => $faker->randomNumber(9),
            'pais' =>  $faker->country,
            'ciudad' => $faker->city,
            "web" => $faker->domainName,
            'sociedad' => $faker->randomElement(["SL","SA","SAE","SLNE","AUT"]),
            "fecha_fundacion" => $faker->date("Y-m-d"),
            "min_empleados" => $faker->numberBetween(2,5000),
            "max_empleados" => $faker->numberBetween(2,1000),
            "descripcion" => $faker->text()
        ];

        //When
        $this->actingAs(Teacher::isAdmin(1)->inRandomOrder()->first()->user);
        $this->visit(route('enterprise.create'))
            ->type($enterprise_opts["email"],"email")
            ->type($enterprise_opts["name"],"name")
            ->type($enterprise_opts["password"],"password")
            ->type($enterprise_opts["password_confirmation"],"password_confirmation")
            ->type($enterprise_opts["phone"],"phone")
            ->type($enterprise_opts["fax"],"fax")
            ->type($enterprise_opts["web"],"web")
            ->type($enterprise_opts["fecha_fundacion"],"fecha_fundacion")
            ->type($enterprise_opts["cif"],"cif")
            ->type($enterprise_opts["pais"],"pais")
            ->type($enterprise_opts["ciudad"],"ciudad")
            ->type($enterprise_opts["descripcion"],"descripcion")
            ->type($enterprise_opts["min_empleados"],"min_empleados")
            ->type($enterprise_opts["max_empleados"],"max_empleados")
            ->select($enterprise_opts["sociedad"],"sociedad")
            ->press("Guardar");

        //Then
        $this->seeInDatabase('users',["email" => $enterprise_opts["email"],"name" => $enterprise_opts["name"],"phone" => $enterprise_opts["phone"],"is_active" => 0])
            ->seeInDatabase("enterprises",
                [
                    "sociedad" => $enterprise_opts["sociedad"],
                    "cif" => $enterprise_opts["cif"],
                    "web" => $enterprise_opts["web"],
                    "fax" => $enterprise_opts["fax"],
                    "ciudad" => $enterprise_opts["ciudad"],
                    "pais" => $enterprise_opts["pais"],
                    "fecha_fundacion" => $enterprise_opts["fecha_fundacion"],
                    "min_empleados" => $enterprise_opts["min_empleados"],
                    "max_empleados" => $enterprise_opts["max_empleados"]
                ]
            );

        return $enterprise_opts;

    }

    /**
     * Prueba si puedo crear una empresa logueado como teacher.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_teacher_can_create_a_enterprise()
    {
        //Having
        $this->actingAs(Teacher::isAdmin(0)->inRandomOrder()->first()->user);
        //WHEN

        $this->get(route("enterprise.create"));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
    }


    /**
     * Prueba si puedo crear una empresa logueado como empresa.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_enterprise_can_create_a_enterprise(){
        //HAVING
        $this->actingAs(Enterprise::first()->user);

        //WHEN
        $this->get(route("enterprise.create"));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
    }

    /**
     * Prueba si puedo crear una empresa logueado como alumno.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_student_can_create_a_enterprise(){
        //HAVING
        $this->actingAs(Student::first()->user);

        //WHEN
        $this->get(route("enterprise.create"));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
    }


    /**
     * Prueba si puedo editar una empresa logueado como administrador.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_admin_can_edit_a_enterprise()
    {

        //Having
        $faker =  Faker::create('es_ES');
        $enterprise = Enterprise::inRandomOrder()->first();
        $pass = $faker->password();
        $enterprise_opts = [
            "email" => $faker->email,
            "name" => $faker->company,
            "password" => $pass,
            "password_confirmation" => $pass,
            "phone" => $faker->randomNumber(9),
            'cif'   => $faker->randomNumber(9),
            'fax'   => $faker->randomNumber(9),
            'pais' =>  $faker->country,
            'ciudad' => $faker->city,
            "web" => $faker->domainName,
            'sociedad' => $faker->randomElement(["SL","SA","SAE","SLNE","AUT"]),
            "fecha_fundacion" => $faker->date("Y-m-d"),
            "min_empleados" => $faker->numberBetween(2,5000),
            "max_empleados" => $faker->numberBetween(2,1000),
            "descripcion" => $faker->text()
        ];

        //When
        $this->actingAs(Teacher::isAdmin(1)->first()->user);
        $this->visit(route('enterprise.edit',$enterprise->id))
            ->type($enterprise_opts["email"],"email")
            ->type($enterprise_opts["name"],"name")
            ->type($enterprise_opts["phone"],"phone")
            ->type($enterprise_opts["fax"],"fax")
            ->type($enterprise_opts["web"],"web")
            ->type($enterprise_opts["fecha_fundacion"],"fecha_fundacion")
            ->type($enterprise_opts["cif"],"cif")
            ->type($enterprise_opts["pais"],"pais")
            ->type($enterprise_opts["ciudad"],"ciudad")
            ->type($enterprise_opts["descripcion"],"descripcion")
            ->type($enterprise_opts["min_empleados"],"min_empleados")
            ->type($enterprise_opts["max_empleados"],"max_empleados")
            ->select($enterprise_opts["sociedad"],"sociedad");

        if($faker->boolean(30)){
            $this->type($enterprise_opts["password"],"password")
                 ->type($enterprise_opts["password_confirmation"],"password_confirmation");
        }

        $this->press("Guardar");

        //Then
        $this->seeInDatabase('users',["email" => $enterprise_opts["email"],"name" => $enterprise_opts["name"],"phone" => $enterprise_opts["phone"]])
            ->seeInDatabase("enterprises",
                [
                    "sociedad" => $enterprise_opts["sociedad"],
                    "cif" => $enterprise_opts["cif"],
                    "web" => $enterprise_opts["web"],
                    "fax" => $enterprise_opts["fax"],
                    "ciudad" => $enterprise_opts["ciudad"],
                    "pais" => $enterprise_opts["pais"],
                    "fecha_fundacion" => $enterprise_opts["fecha_fundacion"],
                    "min_empleados" => $enterprise_opts["min_empleados"],
                    "max_empleados" => $enterprise_opts["max_empleados"]
                ]
            );

        return $enterprise_opts;

    }

    /**
     * Prueba si puedo editar una empresa logueado como teacher.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_teacher_can_edit_a_enterprise()
    {
        //Having
        $faker =  Faker::create('es_ES');
        $enterprise = Enterprise::inRandomOrder()->first();

        //When
        $this->actingAs(Teacher::isAdmin(0)->first()->user);
        $this->get(route("enterprise.edit",$enterprise->id));

        //Then
        $this->seeStatusCode(403); //403 = Forbidden

    }

    /**
     * Prueba si puedo editar mi empresa logueado como esa misma empresa.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_enterprise_can_edit_herself()
    {
        //Having
        $faker =  Faker::create('es_ES');
        $enterprise = Enterprise::inRandomOrder()->first();
        $pass = $faker->password();
        $enterprise_opts = [
            "email" => $faker->email,
            "name" => $faker->company,
            "password" => $pass,
            "password_confirmation" => $pass,
            "phone" => $faker->randomNumber(9),
            'cif'   => $faker->randomNumber(9),
            'fax'   => $faker->randomNumber(9),
            'pais' =>  $faker->country,
            'ciudad' => $faker->city,
            "web" => $faker->domainName,
            'sociedad' => $faker->randomElement(["SL","SA","SAE","SLNE","AUT"]),
            "fecha_fundacion" => $faker->date("Y-m-d"),
            "min_empleados" => $faker->numberBetween(2,5000),
            "max_empleados" => $faker->numberBetween(2,1000),
            "descripcion" => $faker->text()
        ];

        //When
        $this->actingAs($enterprise->user);
        $this->visit(route('enterprise.edit',$enterprise->id))
            ->type($enterprise_opts["email"],"email")
            ->type($enterprise_opts["name"],"name")
            ->type($enterprise_opts["phone"],"phone")
            ->type($enterprise_opts["fax"],"fax")
            ->type($enterprise_opts["web"],"web")
            ->type($enterprise_opts["fecha_fundacion"],"fecha_fundacion")
            ->type($enterprise_opts["cif"],"cif")
            ->type($enterprise_opts["pais"],"pais")
            ->type($enterprise_opts["ciudad"],"ciudad")
            ->type($enterprise_opts["descripcion"],"descripcion")
            ->type($enterprise_opts["min_empleados"],"min_empleados")
            ->type($enterprise_opts["max_empleados"],"max_empleados")
            ->select($enterprise_opts["sociedad"],"sociedad");

        if($faker->boolean(30)){
            $this->type($enterprise_opts["password"],"password")
                ->type($enterprise_opts["password_confirmation"],"password_confirmation");
        }

        $this->press("Guardar");

        //Then
        $this->seeInDatabase('users',["email" => $enterprise_opts["email"],"name" => $enterprise_opts["name"],"phone" => $enterprise_opts["phone"]])
            ->seeInDatabase("enterprises",
                [
                    "sociedad" => $enterprise_opts["sociedad"],
                    "cif" => $enterprise_opts["cif"],
                    "web" => $enterprise_opts["web"],
                    "fax" => $enterprise_opts["fax"],
                    "ciudad" => $enterprise_opts["ciudad"],
                    "pais" => $enterprise_opts["pais"],
                    "fecha_fundacion" => $enterprise_opts["fecha_fundacion"],
                    "min_empleados" => $enterprise_opts["min_empleados"],
                    "max_empleados" => $enterprise_opts["max_empleados"]
                ]
            );

        return $enterprise_opts;

    }

    /**
     * Prueba si puedo editar mi empresa logueado como esa misma empresa.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_enterprise_cannot_edit_a_enterprise()
    {
        //Having
        $user = Enterprise::inRandomOrder()->first()->user;
        $enterprise = Enterprise::inRandomOrder()->first();

        //When
        $this->actingAs($user);
        $this->get(route("enterprise.edit",$enterprise->id));

        //Then
        $this->seeStatusCode(403); //403 = Forbidden
    }



    /**
     * Prueba si puedo editar una empresa logueado como alumno.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_student_cannot_edit_a_enterprise()
    {
        //Having
        $user = Student::inRandomOrder()->first()->user;
        $enterprise = Enterprise::inRandomOrder()->first();

        //When
        $this->actingAs($user);
        $this->get(route("enterprise.edit",$enterprise->id));

        //Then
        $this->seeStatusCode(403); //403 = Forbidden
    }


    /**
     * Prueba si puedo eliminar una empresa logueado como administrador.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_admin_can_delete_a_enterprise()
    {

        //Having
        $user = Teacher::isAdmin(1)->inRandomOrder()->first()->user;
        $enterprise = Enterprise::inRandomOrder()->first();

        //When
        $this->actingAs($user);
        $this->delete(route("enterprise.destroy",$enterprise->id));

        //Then
        $this->notSeeInDatabase("enterprises",$enterprise->getAttributes()); //401 = Forbidden

    }


    /**
     * Prueba si puedo eliminar una empresa logueado como teacher.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_teacher_can_delete_a_enterprise()
    {

        //Having
        $user = Teacher::isAdmin(0)->inRandomOrder()->first()->user;
        $enterprise = Enterprise::inRandomOrder()->first();

        //When
        $this->actingAs($user);
        $this->delete(route("enterprise.destroy",$enterprise->id));

        //Then
        $this->seeStatusCode(403); //403 = Forbidden
        $this->seeInDatabase("enterprises",$enterprise->getAttributes()); //401 = Forbidden

    }


    /**
     * Prueba si puedo eliminar una empresa logueado como enterprise.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_enterprise_can_delete_a_herself()
    {

        //Having
        $user = Enterprise::inRandomOrder()->first()->user;

        //When
        $this->actingAs($user);
        $this->delete(route("enterprise.destroy",$user->enterprise->id));

        //Then
        $this->notSeeInDatabase("enterprises",$user->enterprise->getAttributes()); //401 = Forbidden

    }


    /**
     * Prueba si puedo ver el index logueado como admin.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_admin_can_see_the_enterprises()
    {
        //HAVING
        $enterprise = Enterprise::inRandomOrder()->first();

        //WHEN
        $this->actingAs(Teacher::isAdmin(1)->first()->user);
        $this->visit(route("enterprise.index"));

        //THEN
        $this->see($enterprise->user->name)
             ->see($enterprise->sociedad);
        $this->seeInDatabase("enterprises",$enterprise->getAttributes());

    }


    /**
     * Prueba si puedo ver el index logueado como teacher.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_teacher_can_see_the_enterprises()
    {
        //HAVING
        $enterprise = Enterprise::inRandomOrder()->first();

        //WHEN
        $this->actingAs(Teacher::isAdmin(0)->first()->user);
        $this->visit(route("enterprise.index"));

        //THEN
        $this->see($enterprise->name)
            ->see($enterprise->sociedad);
        $this->seeInDatabase("enterprises",$enterprise->getAttributes());

    }

    /**
     * Prueba si puedo ver el index logueado como enterprise.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_enterprise_cannot_see_the_enterprises()
    {
        //HAVING
        $enterprise = Enterprise::inRandomOrder()->first();

        //WHEN
        $this->actingAs(Enterprise::inRandomOrder()->first()->user);
        $this->get(route("enterprise.index"));

        //THEN
        $this->seeStatusCode(403); //Forbidden
        $this->seeInDatabase("enterprises",$enterprise->getAttributes());

    }

    /**
     * Prueba si puedo ver el index logueado como student.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_student_cannot_see_the_enterprises()
    {
        //HAVING
        $enterprise = Enterprise::inRandomOrder()->first();

        //WHEN
        $this->actingAs(Student::inRandomOrder()->first()->user);
        $this->get(route("enterprise.index"));

        //THEN
        $this->seeStatusCode(403); //Forbidden
        $this->seeInDatabase("enterprises",$enterprise->getAttributes());

    }


    /**
     * Prueba si puedo entrar al show de un ciclo logueado como admin.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_admin_can_see_the_show_of_a_enterprise()
    {
        //HAVING
        $enterprise = Enterprise::inRandomOrder()->first();


        //WHEN
        $this->actingAs(Teacher::isAdmin(1)->inRandomOrder()->first()->user);
        $this->visit(route("user.profile",$enterprise->user->id));

        //THEN
        $this->see($enterprise->user->name)
            ->see($enterprise->id);
        $this->seeInDatabase('enterprises',$enterprise->getAttributes());
    }


    /**
     * Prueba si puedo entrar al show de un ciclo logueado como teacher.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_teacher_can_see_the_show_of_a_enterprise()
    {
        //HAVING
        $enterprise = Enterprise::inRandomOrder()->first();


        //WHEN
        $this->actingAs(Teacher::isAdmin(0)->inRandomOrder()->first()->user);
        $this->visit(route("user.profile",$enterprise->user->id));

        //THEN
        $this->see($enterprise->name)
            ->see($enterprise->id);
        $this->seeInDatabase('enterprises',$enterprise->getAttributes());
    }

    /**
     * Prueba si puedo entrar al show de un ciclo logueado como student.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_student_cannot_see_the_show_of_a_enterprise()
    {
        //HAVING
        $enterprise = Enterprise::inRandomOrder()->first();


        //WHEN
        $this->actingAs(Student::inRandomOrder()->first()->user);
        $this->visit(route("user.profile",$enterprise->user->id));

        //THEN
        $this->see($enterprise->name)
            ->see($enterprise->id);
        $this->seeInDatabase('enterprises',$enterprise->getAttributes());
    }


    /**
     * Prueba si puedo entrar al show de una empresa logueado como enterprise.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_enterprise_cannot_see_the_show_of_a_enterprise()
    {
        //HAVING
        $enterprise = Enterprise::inRandomOrder()->first();

        //WHEN
        $this->actingAs(Enterprise::inRandomOrder()->first()->user);
        $this->visit(route("user.profile",$enterprise->user->id));

        //THEN
        $this->see($enterprise->name)
            ->see($enterprise->id);
        $this->seeInDatabase('enterprises',$enterprise->getAttributes());

    }







}
