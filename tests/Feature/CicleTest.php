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


/**
 * ClassTest para probar el CRUD e interacciones relacionadas con la entidad Cicle
 * @package Tests\Feature
 */

class CicleTest extends TestCase
{

    use DatabaseTransactions;


    /**
     * Prueba si puedo crear un ciclo logueado como administrador.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_admin_can_create_a_cicle()
    {

        //HAVING
        $faker = Faker::create('es_ES');
        $family_id = $faker->randomElement(get_model_all_id(Family::all()));

        $name = $faker->randomElement($faker->randomElement(config("families"))["ciclos"])["name"];
        $tipo = $faker->randomElement($faker->randomElement(config("families"))["ciclos"])["tipo"];
        $plan = $faker->randomElement($faker->randomElement(config("families"))["ciclos"])["plan"];

        $this->actingAs(Teacher::isAdmin(1)->first()->user);

        //WHEN
        $this->visit(route("cicle.create"))
                ->type($name,'name')
                ->select($family_id,"family_id")
                ->select($tipo,"tipo")
                ->select($plan,"plan")
                ->press("save");

        //THEN
        $this->seeInDatabase('cicles',['family_id' => $family_id , 'name' => $name , "tipo" => $tipo , "plan" => $plan]);

        return ['family_id' => $family_id , 'name' => $name , "tipo" => $tipo , "plan" => $plan];

    }



    /**
     * Prueba si puedo crear un ciclo logueado como teacher.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_teacher_cannot_create_a_cicle()
    {
        //HAVING
        $this->actingAs(Teacher::isAdmin(0)->first()->user);

        //WHEN
        $this->get(route("cicle.create"));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
    }


    /**
     * Prueba si puedo crear un ciclo logueado como student.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_student_cannot_create_a_cicle()
    {
        //HAVING
        $this->actingAs(Student::first()->user);

        //WHEN
        $this->get(route("cicle.create"));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
    }


    /**
     * Prueba si puedo crear un ciclo logueado como student.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_enterprise_cannot_create_a_cicle()
    {
        //HAVING
        $this->actingAs(Enterprise::first()->user);

        //WHEN
        $this->get(route("cicle.create"));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
    }

    /**
     * Prueba si puedo entrar al index de ciclos logueado como administrador.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_admin_can_see_the_cicles()
    {

        //HAVING
        $this->actingAs(Teacher::isAdmin(1)->first()->user);

        //WHEN
        $cicle = $this->test_a_admin_can_create_a_cicle();

        $this->visit(route("cicle.index"));

        //THEN
        $this->see($cicle["name"])
            ->see($cicle["tipo"])
            ->see($cicle["plan"]);
    }


    /**
     * Prueba si puedo entrar al index de ciclos logueado como teacher.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_teacher_cannot_see_the_cicles()
    {
        //HAVING
        $this->actingAs(Teacher::isAdmin(0)->first()->user);

        //WHEN
        $this->get(route("cicle.index"));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
    }


    /**
     * Prueba si puedo entrar al index de ciclos logueado como student.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_student_cannot_see_the_cicles()
    {
        //HAVING
        $this->actingAs(Student::first()->user);

        //WHEN
        $this->get(route("cicle.index"));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
    }


    /**
     * Prueba si puedo entrar al index de ciclos logueado como enterprise.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_enterprise_cannot_see_the_cicles()
    {
        //HAVING
        $this->actingAs(Enterprise::first()->user);

        //WHEN
        $this->get(route("cicle.index"));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
    }

    /**
     * Prueba si puedo editar un ciclo logueado como administrador.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_admin_can_edit_a_cicle()
    {

        //HAVING
        $this->actingAs(Teacher::isAdmin(1)->first()->user);
        $ciclecreate = $this->test_a_admin_can_create_a_cicle();
        $cicle = Cicle::where("name",$ciclecreate["name"])->where("family_id",$ciclecreate["family_id"])->where("tipo",$ciclecreate["tipo"])->where("plan",$ciclecreate["plan"])->first();
        $faker = Faker::create('es_ES');
        $data = [
            "name" => "Desarrollo de Aplicaciones Multiplataforma (DAM)",
            "tipo" => $faker->randomElement(["CFGS","CFGM","FPB"]),
            "plan" => $faker->randomElement(["LOE","LOGSE","LOMCE"])
        ];

        //WHEN
        $this->visit(route("cicle.edit",$cicle->id));

        $this->see($cicle->name)
            ->see($cicle->tipo)
            ->see($cicle->plan);

        $this->type($data["name"],'name')
            ->select($data["tipo"],"tipo")
            ->select($data["plan"],"plan")
            ->press("Guardar");


        //THEN
        $this->seeInDatabase('cicles',$data);
    }

    /**
     * Prueba si puedo entrar al index de ciclos logueado como teacher.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_teacher_cannot_edit_a_cicle()
    {
        //HAVING
        $ciclecreate = $this->test_a_admin_can_create_a_cicle();
        $cicle = Cicle::where("name",$ciclecreate["name"])->where("family_id",$ciclecreate["family_id"])->where("tipo",$ciclecreate["tipo"])->where("plan",$ciclecreate["plan"])->first();


        //WHEN
        $this->actingAs(Teacher::isAdmin(0)->first()->user);
        $this->get(route("cicle.edit",$cicle->id));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
    }


    /**
     * Prueba si puedo entrar al index de ciclos logueado como student.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_student_cannot_edit_a_cicle()
    {
        //HAVING
        $ciclecreate = $this->test_a_admin_can_create_a_cicle();
        $cicle = Cicle::where("name",$ciclecreate["name"])->where("family_id",$ciclecreate["family_id"])->where("tipo",$ciclecreate["tipo"])->where("plan",$ciclecreate["plan"])->first();


        //WHEN
        $this->actingAs(Student::first()->user);
        $this->get(route("cicle.edit",$cicle->id));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
    }


    /**
     * Prueba si puedo entrar al index de ciclos logueado como enterprise.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_enterprise_cannot_edit_a_cicle()
    {
        //HAVING
        $ciclecreate = $this->test_a_admin_can_create_a_cicle();
        $cicle = Cicle::where("name",$ciclecreate["name"])->where("family_id",$ciclecreate["family_id"])->where("tipo",$ciclecreate["tipo"])->where("plan",$ciclecreate["plan"])->first();


        //WHEN
        $this->actingAs(Enterprise::first()->user);
        $this->get(route("cicle.edit",$cicle->id));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
    }


    public function test_a_admin_can_delete_a_cicle()
    {

        //HAVING
        $this->actingAs(Teacher::isAdmin(1)->first()->user);
        $cicle = Cicle::first();

        //WHEN
        $this->delete(route("cicle.destroy",$cicle->id));

        //THEN
        $this->notSeeInDatabase('cicles',$cicle->getAttributes());
    }

    /**
     * Prueba si puedo entrar al index de ciclos logueado como teacher.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_teacher_cannot_delete_a_cicle()
    {
        //HAVING
        $ciclecreate = $this->test_a_admin_can_create_a_cicle();
        $cicle = Cicle::where("name",$ciclecreate["name"])->where("family_id",$ciclecreate["family_id"])->where("tipo",$ciclecreate["tipo"])->where("plan",$ciclecreate["plan"])->first();


        //WHEN
        $this->actingAs(Teacher::isAdmin(0)->first()->user);
        $this->delete(route("cicle.destroy",$cicle->id));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
        $this->seeInDatabase('cicles',$cicle->getAttributes());
    }


    /**
     * Prueba si puedo entrar al index de ciclos logueado como student.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_student_cannot_delete_a_cicle()
    {
        //HAVING
        $ciclecreate = $this->test_a_admin_can_create_a_cicle();
        $cicle = Cicle::where("name",$ciclecreate["name"])->where("family_id",$ciclecreate["family_id"])->where("tipo",$ciclecreate["tipo"])->where("plan",$ciclecreate["plan"])->first();


        //WHEN
        $this->actingAs(Student::first()->user);
        $this->delete(route("cicle.destroy",$cicle->id));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
        $this->seeInDatabase('cicles',$cicle->getAttributes());
    }


    /**
     * Prueba si puedo entrar al index de ciclos logueado como enterprise.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_enterprise_cannot_delete_a_cicle()
    {
        //HAVING
        $ciclecreate = $this->test_a_admin_can_create_a_cicle();
        $cicle = Cicle::where("name",$ciclecreate["name"])->where("family_id",$ciclecreate["family_id"])->where("tipo",$ciclecreate["tipo"])->where("plan",$ciclecreate["plan"])->first();


        //WHEN
        $this->actingAs(Enterprise::first()->user);
        $this->delete(route("cicle.destroy",$cicle->id));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
        $this->seeInDatabase('cicles',$cicle->getAttributes());
    }


    /**
     * Prueba si puedo entrar al show de un ciclo logueado como admin.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_admin_can_see_the_show_of_a_cicle()
    {
        //HAVING
        $cicle = Cicle::inRandomOrder()->first();


        //WHEN
        $this->actingAs(Teacher::isAdmin(1)->inRandomOrder()->first()->user);
        $this->visit(route("cicle.show",$cicle->id));

        //THEN
        $this->see($cicle->name)
             ->see($cicle->id);
        $this->seeInDatabase('cicles',$cicle->getAttributes());
    }


    /**
     * Prueba si puedo entrar al show de un ciclo logueado como teacher.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_teacher_can_see_the_show_of_a_cicle()
    {
        //HAVING
        $cicle = Cicle::inRandomOrder()->first();


        //WHEN
        $this->actingAs(Teacher::isAdmin(0)->inRandomOrder()->first()->user);
        $this->get(route("cicle.show",$cicle->id));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
        $this->seeInDatabase('cicles',$cicle->getAttributes());
    }

    /**
     * Prueba si puedo entrar al show de un ciclo logueado como student.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_student_cannot_see_the_show_of_a_cicle()
    {
        //HAVING
        $cicle = Cicle::inRandomOrder()->first();


        //WHEN
        $this->actingAs(Student::inRandomOrder()->first()->user);
        $this->get(route("cicle.show",$cicle->id));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
        $this->seeInDatabase('cicles',$cicle->getAttributes());
    }


    /**
     * Prueba si puedo entrar al show de un ciclo logueado como enterprise.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_enterprise_cannot_see_the_show_of_a_cicle()
    {
        //HAVING
        $cicle = Cicle::inRandomOrder()->first();


        //WHEN
        $this->actingAs(Enterprise::inRandomOrder()->first()->user);
        $this->get(route("cicle.show",$cicle->id));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
        $this->seeInDatabase('cicles',$cicle->getAttributes());
    }

}
