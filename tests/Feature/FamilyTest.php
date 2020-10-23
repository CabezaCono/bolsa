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

class FamilyTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * Prueba si puedo crear una familia logueado como administrador.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_admin_can_create_a_family()
    {

        //HAVING
        $faker = Faker::create('es_ES');
        $family_id = $faker->randomElement(get_model_all_id(Family::all()));
        $name = $faker->randomElement(config("families"))["name"];
        $this->actingAs(Teacher::isAdmin(1)->first()->user);

        //WHEN
        $this->visit(route("family.create"))
            ->type($name,'name')
            ->press("Guardar");

        //THEN
        $this->seeInDatabase('families',['name' => $name]);

        return ['name' => $name];

    }

    /**
     * Prueba si puedo crear una familia logueado como teacher.
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
        $this->get(route("family.create"));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
    }


    /**
     * Prueba si puedo crear una familia logueado como student.
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
        $this->get(route("family.create"));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
    }


    /**
     * Prueba si puedo crear una familia logueado como student.
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
        $this->get(route("family.create"));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
    }


    /**
     * Prueba si puedo entrar al index de familias logueado como administrador.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_admin_can_see_the_families()
    {

        //HAVING
        $this->actingAs(Teacher::isAdmin(1)->first()->user);

        //WHEN
        $family = $this->test_a_admin_can_create_a_family();

        $this->visit(route("family.index"));

        //THEN
        $this->see($family["name"]);
        $this->seeInDatabase("families",["name" => $family["name"]]);
    }



    /**
     * Prueba si puedo entrar al index de familias logueado como teacher.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_teacher_cannot_see_the_families()
    {
        //HAVING
        $this->actingAs(Teacher::isAdmin(0)->first()->user);

        //WHEN
        $this->get(route("family.index"));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
    }


    /**
     * Prueba si puedo entrar al index de familias logueado como student.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_student_cannot_see_the_families()
    {
        //HAVING
        $this->actingAs(Student::first()->user);

        //WHEN
        $this->get(route("family.index"));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
    }


    /**
     * Prueba si puedo entrar al index de familias logueado como enterprise.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_enterprise_cannot_see_the_families()
    {
        //HAVING
        $this->actingAs(Enterprise::first()->user);

        //WHEN
        $this->get(route("family.index"));

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
    public function test_a_admin_can_edit_a_family()
    {

        //HAVING
        $this->actingAs(Teacher::isAdmin(1)->first()->user);
        $familycreate = $this->test_a_admin_can_create_a_family();
        $family = Family::where("name",$familycreate["name"])->first();

        $faker = Faker::create('es_ES');
        $data = [
            "name" => $faker->randomElement(config("families"))["name"]
        ];

        //WHEN
        $this->visit(route("family.edit",$family->id));

        $this->see($family->name);

        $this->type($data["name"],'name')->press("Guardar");

        //THEN
        $this->seeInDatabase('families',$data);
    }

    /**
     * Prueba si puedo entrar al index de ciclos logueado como teacher.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_teacher_cannot_edit_a_family()
    {
        //HAVING
        $familycreate = $this->test_a_admin_can_create_a_family();
        $family = Family::where("name",$familycreate["name"])->first();


        //WHEN
        $this->actingAs(Teacher::isAdmin(0)->first()->user);
        $this->get(route("family.edit",$family->id));

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
    public function test_a_student_cannot_edit_a_family()
    {
        //HAVING
        $familycreate = $this->test_a_admin_can_create_a_family();
        $family = Family::where("name",$familycreate["name"])->first();


        //WHEN
        $this->actingAs(Student::first()->user);
        $this->get(route("family.edit",$family->id));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
    }


    /**
     * Prueba si puedo editar una familia logueado como enterprise.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_enterprise_cannot_edit_a_family()
    {
        //HAVING
        $familycreate = $this->test_a_admin_can_create_a_family();
        $family = Family::where("name",$familycreate["name"])->first();


        //WHEN
        $this->actingAs(Enterprise::first()->user);
        $this->get(route("family.edit",$family->id));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
    }

    /**
     * Prueba si puedo eliminar una familia logueado como enterprise.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_admin_can_delete_a_family()
    {

        //HAVING
        $this->actingAs(Teacher::isAdmin(1)->first()->user);
        $family = Family::inRandomOrder()->first();

        //WHEN
        $this->delete(route("family.destroy",$family->id));

        //THEN
        $this->notSeeInDatabase('families',$family->getAttributes());
    }

    /**
     * Prueba si puedo eliminar una familia logueado como teacher.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_teacher_cannot_delete_a_family()
    {
        //HAVING
        $family = Family::inRandomOrder()->first();

        //WHEN
        $this->actingAs(Teacher::isAdmin(0)->first()->user);
        $this->delete(route("cicle.destroy",$family->id));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
        $this->seeInDatabase('families',$family->getAttributes());
    }


    /**
     * Prueba si puedo eliminar una familia logueado como student.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_student_cannot_delete_a_family()
    {
        //HAVING
        $family = Family::inRandomOrder()->first();

        //WHEN
        $this->actingAs(Student::first()->user);
        $this->delete(route("family.destroy",$family->id));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
        $this->seeInDatabase('families',$family->getAttributes());
    }


    /**
     * Prueba si puedo eliminar una familia logueado como enterprise.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_enterprise_cannot_delete_a_family()
    {
        //HAVING
        $family = Family::inRandomOrder()->first();

        //WHEN
        $this->actingAs(Enterprise::first()->user);
        $this->get(route("family.destroy",$family->id));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
        $this->seeInDatabase('families',$family->getAttributes());
    }

    /**
     * Prueba si puedo entrar al show de un ciclo logueado como admin.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_admin_can_see_the_show_of_a_family()
    {
        //HAVING
        $family = Family::inRandomOrder()->first();


        //WHEN
        $this->actingAs(Teacher::isAdmin(1)->inRandomOrder()->first()->user);
        $this->visit(route("family.show",$family->id));

        //THEN
        $this->see($family->name)
            ->see($family->id);
        $this->seeInDatabase('families',$family->getAttributes());
    }


    /**
     * Prueba si puedo entrar al show de un ciclo logueado como teacher.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_teacher_can_see_the_show_of_a_family()
    {
        //HAVING
        $family = Family::inRandomOrder()->first();


        //WHEN
        $this->actingAs(Teacher::isAdmin(0)->inRandomOrder()->first()->user);
        $this->get(route("family.show",$family->id));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
        $this->seeInDatabase('families',$family->getAttributes());
    }

    /**
     * Prueba si puedo entrar al show de un ciclo logueado como student.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_student_cannot_see_the_show_of_a_family()
    {
        //HAVING
        $family = Family::inRandomOrder()->first();


        //WHEN
        $this->actingAs(Student::inRandomOrder()->first()->user);
        $this->get(route("family.show",$family->id));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
        $this->seeInDatabase('families',$family->getAttributes());
    }


    /**
     * Prueba si puedo entrar al show de una family logueado como enterprise.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_enterprise_cannot_see_the_show_of_a_family()
    {
        //HAVING
        $family = Family::inRandomOrder()->first();


        //WHEN
        $this->actingAs(Enterprise::inRandomOrder()->first()->user);
        $this->get(route("family.show",$family->id));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
        $this->seeInDatabase('families',$family->getAttributes());
    }

}
