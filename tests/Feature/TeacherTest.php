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
use Carbon\Carbon;
use Faker\Factory as Faker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TeacherTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * Prueba si puedo crear un profesor logueado como administrador.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_admin_can_create_a_teacher()
    {

        //Having
        $faker =  Faker::create('es_ES');
        $email = $faker->email;
        $date = Carbon::now('UTC')->addDays(1);
        $teacher_opts = [
            "code" => \Doorman::generate()->for($email)->expiresOn($date)->make()->first()->code,
            "email" => $email,
            "name" => $faker->name,
            "apellidos" => $faker->lastName,
            "password" => "123456",
            "password_confirmation" => "123456",
            "phone" => $faker->randomNumber(9),
            'nrp_expediente'   => $faker->randomNumber(9),
        ];
        //When
        $this->actingAs(Teacher::isAdmin(1)->inRandomOrder()->first()->user);
        $this->visit(route('teacher.create'))
            ->type($teacher_opts["code"],"code")
            ->type($teacher_opts["email"],"email")
            ->type($teacher_opts["name"],"name")
            ->type($teacher_opts["apellidos"],"apellidos")
            ->type($teacher_opts["password"],"password")
            ->type($teacher_opts["password_confirmation"],"password_confirmation")
            ->type($teacher_opts["phone"],"phone")
            ->type($teacher_opts["nrp_expediente"],"nrp_expediente")
            ->press("Guardar");

        //Then
        $this->seeInDatabase('users',["email" => $teacher_opts["email"],"name" => $teacher_opts["name"],"phone" => $teacher_opts["phone"],"is_active" => 1])
            ->seeInDatabase("teachers",["nrp_expediente" => $teacher_opts["nrp_expediente"],"apellidos" => $teacher_opts["apellidos"]]);

    }

    /**
     * Prueba si puedo crear un administrador logueado como administrador.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_admin_can_create_a_admin()
    {
        //Having
        $faker =  Faker::create('es_ES');
        $email = $faker->email;
        $date = Carbon::now('UTC')->addDays(1);
        $teacher_opts = [
            "code" => \Doorman::generate()->for($email)->expiresOn($date)->make()->first()->code,
            "email" => $email,
            "name" => $faker->name,
            "apellidos" => $faker->lastName,
            "password" => "123456",
            "password_confirmation" => "123456",
            "phone" => $faker->randomNumber(9),
            'nrp_expediente'   => $faker->randomNumber(9),
        ];
        //When
        $this->actingAs(Teacher::isAdmin(1)->inRandomOrder()->first()->user);
        $this->visit(route('teacher.create'))
            ->type($teacher_opts["code"],"code")
            ->type($teacher_opts["email"],"email")
            ->type($teacher_opts["name"],"name")
            ->type($teacher_opts["apellidos"],"apellidos")
            ->type($teacher_opts["password"],"password")
            ->type($teacher_opts["password_confirmation"],"password_confirmation")
            ->type($teacher_opts["phone"],"phone")
            ->type($teacher_opts["nrp_expediente"],"nrp_expediente")
            ->check("is_admin")
            ->press("Guardar");

        //Then
        $this->seeInDatabase('users',["email" => $teacher_opts["email"],"name" => $teacher_opts["name"],"phone" => $teacher_opts["phone"],"is_active" => 1])
            ->seeInDatabase("teachers",["nrp_expediente" => $teacher_opts["nrp_expediente"],"apellidos" => $teacher_opts["apellidos"],"is_admin" => 1]);

    }

    /**
     * Prueba si puedo crear un profesor logueado como profesor.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_teacher_cannot_create_a_teacher(){
        //HAVING
        $this->actingAs(Teacher::isAdmin(0)->inRandomOrder()->first()->user);

        //WHEN
        $this->get(route("teacher.create"));

        //THEN
        $this->seeStatusCode(403); //Forbidden
    }

    /**
     * Prueba si puedo crear un profesor logueado como empresa.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_enterprise_cannot_create_a_teacher(){
        //HAVING
        $this->actingAs(Enterprise::inRandomOrder()->first()->user);

        //WHEN
        $this->get(route("teacher.create"));

        //THEN
        $this->seeStatusCode(403); // Forbidden
    }

    /**
     * Prueba si puedo crear una empresa logueado como alumno.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_student_cannot_create_a_teacher(){
        //HAVING
        $this->actingAs(Student::first()->user);

        //WHEN
        $this->get(route("teacher.create"));

        //THEN
        $this->seeStatusCode(403); //Forbidden
    }


    /**
     * Prueba si puedo editar un profesor logueado como administrador.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_admin_can_edit_a_teacher()
    {
        //Having
        $faker =  Faker::create('es_ES');
        $teacher = Teacher::isAdmin(0)->inRandomOrder()->first();
        //dd(Teacher::isAdmin(1)->inRandomOrder()->first()->user);
        $teacher_opts = [
            "email" => $faker->email,
            "name" => $faker->firstName,
            "apellidos" => $faker->lastName,
            "phone" => $faker->randomNumber(9),
            'nrp_expediente'   => $faker->randomNumber(9),
            "is_admin" => $faker->boolean()
        ];

        //When
        $this->actingAs(Teacher::isAdmin(1)->inRandomOrder()->first()->user);
        $this->visit(route('teacher.edit',$teacher->id));

        $this->type($teacher_opts["email"],"email")
            ->type($teacher_opts["name"],"name")
            ->type($teacher_opts["apellidos"],"apellidos")
            ->type($teacher_opts["phone"],"phone")
            ->type($teacher_opts["nrp_expediente"],"nrp_expediente");

            if($teacher_opts["is_admin"]){
                $this->check("is_admin");
            }else{
                $this->uncheck("is_admin");
            }

        $this->press("Guardar");

        //Then
        $this->seeInDatabase('users',["id" => $teacher->user->id,"email" => $teacher_opts["email"],"name" => $teacher_opts["name"]])
            ->seeInDatabase("teachers",["nrp_expediente" => $teacher_opts["nrp_expediente"],"apellidos" => $teacher_opts["apellidos"]]);


    }

    /**
     * Prueba si puedo editar un profesor logueado como profesor.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_teacher_cannot_edit_a_teacher(){
        //HAVING
        $this->actingAs(Teacher::isAdmin(0)->inRandomOrder()->first()->user);

        //WHEN
        $this->get(route("teacher.create"));

        //THEN
        $this->seeStatusCode(403); //Forbidden
    }

    /**
     * Prueba si puedo editar un profesor logueado como profesor.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_teacher_can_edit_a_herself(){
        //HAVING
        $teacher = Teacher::isAdmin(0)->Active()->inRandomOrder()->first();
        $faker =  Faker::create('es_ES');
        $email  = $faker->email;
        $teacher_opts = [
            "email" => $email,
            "name" => $faker->name,
            "apellidos" => $faker->lastName,
            "password" => "123456",
            "password_confirmation" => "123456",
            "phone" => $faker->randomNumber(9),
            'nrp_expediente'   => $faker->randomNumber(9),
        ];
        //When
        $this->actingAs($teacher->user);
        $this->visit(route('teacher.edit',$teacher->id))
            ->type($teacher_opts["email"],"email")
            ->type($teacher_opts["name"],"name")
            ->type($teacher_opts["apellidos"],"apellidos")
            ->type($teacher_opts["password"],"password")
            ->type($teacher_opts["password_confirmation"],"password_confirmation")
            ->type($teacher_opts["phone"],"phone")
            ->type($teacher_opts["nrp_expediente"],"nrp_expediente")
            ->press("Guardar");

        //Then
        $this->seeInDatabase('users',["email" => $teacher_opts["email"],"name" => $teacher_opts["name"],"is_active" => 1])
            ->seeInDatabase("teachers",["nrp_expediente" => $teacher_opts["nrp_expediente"],"apellidos" => $teacher_opts["apellidos"],"is_admin" => 0]);
    }

    /**
     * Prueba si puedo editar un profesor logueado como profesor.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_teacher_cannot_make_herself_a_admin(){
        //HAVING
        $teacher = Teacher::isAdmin(0)->Active()->inRandomOrder()->first();
        //When
        $this->actingAs($teacher->user);
        $this->visit(route('teacher.edit',$teacher->id))
            ->see("Admin",false);

        //Then
        $this->seeInDatabase('users',["id" => $teacher->user->id])
            ->seeInDatabase("teachers",["id" => $teacher->id]);
    }

    /**
     * Prueba si puedo editar un profesor logueado como empresa.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_enterprise_cannot_edit_a_teacher(){
        //HAVING
        $this->actingAs(Enterprise::inRandomOrder()->first()->user);

        //WHEN
        $this->get(route("teacher.edit",Teacher::inRandomOrder()->first()->id));

        //THEN
        $this->seeStatusCode(403); //Forbidden
    }

    /**
     * Prueba si puedo crear una empresa logueado como alumno.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_student_cannot_edit_a_teacher(){
        //HAVING
        $this->actingAs(Student::first()->user);

        //WHEN
        $this->get(route("teacher.edit",Teacher::inRandomOrder()->first()->id));

        //THEN
        $this->seeStatusCode(403); //Forbidden
    }

    /**
     * Prueba si puedo eliminar un profesor logueado como administrador.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_admin_can_delete_a_teacher()
    {

        //Having
        $user = Teacher::isAdmin(1)->inRandomOrder()->first()->user;
        $teacher = Teacher::isAdmin(0)->inRandomOrder()->first();

        //When
        $this->actingAs($user);
        $this->delete(route("teacher.destroy",$teacher->id));

        //Then
        $this->notSeeInDatabase("teachers",$teacher->getAttributes());

    }

    /**
     * Prueba si puedo eliminar un profesor logueado como profesor.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_teacher_cannot_delete_other_teacher()
    {

        //Having
        $user = Teacher::isAdmin(0)->inRandomOrder()->first()->user;
        $teacher = Teacher::isAdmin(0)->inRandomOrder()->first();

        //When
        $this->actingAs($user);
        $this->delete(route("teacher.destroy",$teacher->id));

        $this->seeStatusCode(403);
        //Then
        $this->seeInDatabase("teachers",$teacher->getAttributes());

    }

    /**
     * Prueba si puedo eliminar un profesor logueado como ese profesor.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_teacher_can_delete_herself()
    {

        //Having
        $teacher = Teacher::isAdmin(0)->inRandomOrder()->first();

        //When
        $this->actingAs($teacher->user);
        $this->delete(route("teacher.destroy",$teacher->id));

        //Then
        $this->notSeeInDatabase("teachers",$teacher->getAttributes());

    }


    /**
     * Prueba si puedo eliminar un profesor logueado como empresa.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_enterprise_cannot_delete_a_teacher()
    {

        //Having
        $user = Enterprise::inRandomOrder()->first()->user;
        $teacher = Teacher::inRandomOrder()->first();

        //When
        $this->actingAs($user);
        $this->delete(route("teacher.destroy",$teacher->id));

        $this->seeStatusCode(403);
        //Then
        $this->seeInDatabase("teachers",$teacher->getAttributes());

    }


    /**
     * Prueba si puedo eliminar un profesor logueado como alumno.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_student_cannot_delete_a_teacher()
    {

        //Having
        $user = Student::inRandomOrder()->first()->user;
        $teacher = Teacher::inRandomOrder()->first();

        //When
        $this->actingAs($user);
        $this->delete(route("teacher.destroy",$teacher->id));

        $this->seeStatusCode(403);
        //Then
        $this->seeInDatabase("teachers",$teacher->getAttributes());

    }

    /**
     * Prueba si puedo ver el index logueado como admin.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_admin_can_see_the_teachers()
    {
        //HAVING
        $teacher = Teacher::Active()->inRandomOrder()->first();

        //WHEN
        $this->actingAs(Teacher::isAdmin(1)->first()->user);
        $this->visit(route("teacher.index"));

        //THEN
        $this->see($teacher->user->name)
            ->see($teacher->id)
            ->see($teacher->user->email);
        $this->seeInDatabase("teachers",$teacher->getAttributes());

    }


    /**
     * Prueba si puedo ver el index logueado como teacher.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_teacher_cannot_see_the_teachers()
    {

        //HAVING
        $this->actingAs(Teacher::isAdmin(0)->first()->user);
        //WHEN

        $this->get(route("teacher.index"));

        //THEN
        $this->seeStatusCode(403);

    }

    /**
     * Prueba si puedo ver el index logueado como enterprise.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_enterprise_cannot_see_the_teachers()
    {

        //HAVING
        $this->actingAs(Enterprise::first()->user);
        //WHEN

        $this->get(route("teacher.index"));

        //THEN
        $this->seeStatusCode(403);

    }

    /**
     * Prueba si puedo ver el index logueado como student.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_student_cannot_see_the_teachers()
    {

        //HAVING
        $this->actingAs(Student::first()->user);
        //WHEN

        $this->get(route("teacher.index"));

        //THEN
        $this->seeStatusCode(403);

    }

    /**
     * Prueba si puedo entrar al show logueado como admin.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_admin_can_see_the_show_of_a_teacher()
    {
        //HAVING
        $teacher = Teacher::Active()->inRandomOrder()->first();

        //WHEN
        $this->actingAs(Teacher::isAdmin(1)->inRandomOrder()->first()->user);
        $this->visit(route("user.profile",$teacher->user->id));

        //THEN
        $this->see($teacher->name)
            ->see($teacher->id);
        $this->seeInDatabase('teachers',$teacher->getAttributes());

    }

    /**
     * Prueba si puedo entrar al show logueado como teacher.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_teacher_can_see_the_show_of_a_teacher()
    {
        //HAVING
        $teacher = Teacher::Active()->inRandomOrder()->first();

        //WHEN
        $this->actingAs(Teacher::isAdmin(0)->inRandomOrder()->first()->user);
        $this->visit(route("user.profile",$teacher->user->id));

        //THEN
        $this->see($teacher->name)
            ->see($teacher->id);
        $this->seeInDatabase('teachers',$teacher->getAttributes());

    }

    /**
     * Prueba si puedo entrar al show logueado como student.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_student_can_see_the_show_of_a_teacher()
    {
        //HAVING
        $teacher = Teacher::Active()->inRandomOrder()->first();

        //WHEN
        $this->actingAs(Student::inRandomOrder()->first()->user);
        $this->visit(route("user.profile",$teacher->user->id));

        //THEN
        $this->see($teacher->name)
            ->see($teacher->id);
        $this->seeInDatabase('teachers',$teacher->getAttributes());

    }

    /**
     * Prueba si puedo entrar al show logueado como enterprise.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_enterprise_can_see_the_show_of_a_teacher()
    {
        //HAVING
        $teacher = Teacher::Active()->inRandomOrder()->first();

        //WHEN
        $this->actingAs(Enterprise::inRandomOrder()->first()->user);
        $this->visit(route("user.profile",$teacher->user->id));

        //THEN
        $this->see($teacher->name)
            ->see($teacher->id);
        $this->seeInDatabase('teachers',$teacher->getAttributes());

    }
}
