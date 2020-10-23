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

class StudentTest extends TestCase
{
    use DatabaseTransactions;


    /**
     * Prueba si puedo crear un alumno logueado como administrador.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_admin_can_create_a_student()
    {

        //Having
        $faker =  Faker::create('es_ES');
        $pass = $faker->password();
        $student_opts = [
            "email" => $faker->email,
            "name" => $faker->company,
            "apellidos" => $faker->lastName,
            "password" => $pass,
            "password_confirmation" => $pass,
            "phone" => $faker->randomNumber(9),
            'nre'   => $faker->randomNumber(9),
            'domicilio' => $faker->address,
            'status' => $faker->randomElement(['ESTUDIANDO',"FCT", "CONTRATADO", "PARO"]),
            "edad" => $faker->numberBetween(16,90),
            "vehiculo" => $faker->boolean()
        ];

        //When
        $this->actingAs(Teacher::isAdmin(1)->inRandomOrder()->first()->user);
        $this->visit(route('student.create'))
            ->type($student_opts["email"],"email")
            ->type($student_opts["name"],"name")
            ->type($student_opts["apellidos"],"apellidos")
            ->type($student_opts["password"],"password")
            ->type($student_opts["password_confirmation"],"password_confirmation")
            ->type($student_opts["phone"],"phone")
            ->type($student_opts["nre"],"nre")
            ->type($student_opts["domicilio"],"domicilio")
            ->type($student_opts["edad"],"edad")
            ->type($student_opts["vehiculo"],"vehiculo")
            ->select($student_opts["status"],"status")
            ->press("Guardar");

        //Then
        $this->seeInDatabase('users',["email" => $student_opts["email"],"name" => $student_opts["name"],"phone" => $student_opts["phone"],"is_active" => 0])
            ->seeInDatabase("students",
                [
                    "status" => $student_opts["status"],
                    "edad" => $student_opts["edad"],
                    "nre" => $student_opts["nre"],
                    "apellidos" => $student_opts["apellidos"],
                    "domicilio" => $student_opts["domicilio"],
                    "vehiculo" => $student_opts["vehiculo"]
                ]
            );

        return $student_opts;

    }

    /**
     * Prueba si puedo crear un alumno logueado como teacher.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_teacher_can_create_a_student()
    {

        //Having
        $faker =  Faker::create('es_ES');
        $pass = $faker->password();
        $student_opts = [
            "email" => $faker->email,
            "name" => $faker->company,
            "apellidos" => $faker->lastName,
            "password" => $pass,
            "password_confirmation" => $pass,
            "phone" => $faker->randomNumber(9),
            'nre'   => $faker->randomNumber(9),
            'domicilio' => $faker->address,
            'status' => $faker->randomElement(['ESTUDIANDO',"FCT", "CONTRATADO", "PARO"]),
            "edad" => $faker->numberBetween(16,90),
            "vehiculo" => $faker->boolean()
        ];

        //When
        $this->actingAs(Teacher::isAdmin(0)->inRandomOrder()->first()->user);
        $this->visit(route('student.create'))
            ->type($student_opts["email"],"email")
            ->type($student_opts["name"],"name")
            ->type($student_opts["apellidos"],"apellidos")
            ->type($student_opts["password"],"password")
            ->type($student_opts["password_confirmation"],"password_confirmation")
            ->type($student_opts["phone"],"phone")
            ->type($student_opts["nre"],"nre")
            ->type($student_opts["domicilio"],"domicilio")
            ->type($student_opts["edad"],"edad")
            ->type($student_opts["vehiculo"],"vehiculo")
            ->select($student_opts["status"],"status")
            ->press("Guardar");

        //Then
        $this->seeInDatabase('users',["email" => $student_opts["email"],"name" => $student_opts["name"],"phone" => $student_opts["phone"],"is_active" => 0])
            ->seeInDatabase("students",
                [
                    "status" => $student_opts["status"],
                    "edad" => $student_opts["edad"],
                    "nre" => $student_opts["nre"],
                    "apellidos" => $student_opts["apellidos"],
                    "domicilio" => $student_opts["domicilio"],
                    "vehiculo" => $student_opts["vehiculo"]
                ]
            );

        return $student_opts;

    }



    /**
     * Prueba si puedo crear un student logueado como empresa.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_enterprise_can_create_a_student(){
        //HAVING
        $this->actingAs(Enterprise::inRandomOrder()->first()->user);

        //WHEN
        $this->get(route("student.create"));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
    }

    /**
     * Prueba si puedo crear un student logueado como alumno.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_student_can_create_a_student(){
        //HAVING
        $this->actingAs(Student::inRandomOrder()->first()->user);

        //WHEN
        $this->get(route("student.create"));

        //THEN
        $this->seeStatusCode(403); //403 = Forbidden
    }



    /**
     * Prueba si puedo editar un Student logueado como administrador.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_admin_can_edit_a_student()
    {

        //Having
        $faker =  Faker::create('es_ES');
        $student = Student::inRandomOrder()->first();
        $pass = $faker->password();
        $student_opts = [
            "email" => $faker->email,
            "name" => $faker->company,
            "apellidos" => $faker->lastName,
            "password" => $pass,
            "password_confirmation" => $pass,
            "phone" => $faker->randomNumber(9),
            'nre'   => $faker->randomNumber(9),
            'domicilio' => $faker->address,
            'status' => $faker->randomElement(['ESTUDIANDO',"FCT", "CONTRATADO", "PARO"]),
            "edad" => $faker->numberBetween(16,90),
            "vehiculo" => $faker->boolean()
        ];

        //When
        $this->actingAs(Teacher::isAdmin(1)->first()->user);
        $this->visit(route('student.edit',$student->id))
            ->type($student_opts["email"],"email")
            ->type($student_opts["name"],"name")
            ->type($student_opts["apellidos"],"apellidos")
            ->type($student_opts["password"],"password")
            ->type($student_opts["password_confirmation"],"password_confirmation")
            ->type($student_opts["phone"],"phone")
            ->type($student_opts["nre"],"nre")
            ->type($student_opts["domicilio"],"domicilio")
            ->type($student_opts["edad"],"edad")
            ->type($student_opts["vehiculo"],"vehiculo")
            ->select($student_opts["status"],"status")
            ->press("Editar");

        //Then
        $this->seeInDatabase('users',["email" => $student_opts["email"],"name" => $student_opts["name"],"phone" => $student_opts["phone"],"is_active" => 1])
            ->seeInDatabase("students",
                [
                    "status" => $student_opts["status"],
                    "edad" => $student_opts["edad"],
                    "nre" => $student_opts["nre"],
                    "apellidos" => $student_opts["apellidos"],
                    "domicilio" => $student_opts["domicilio"],
                    "vehiculo" => $student_opts["vehiculo"]
                ]
            );

        return $student_opts;

    }


    /**
     * Prueba si puedo editar un Student logueado como teacher.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_teacher_can_edit_a_student()
    {

        //Having
        $faker =  Faker::create('es_ES');
        $student = Student::Active()->inRandomOrder()->first();
        $pass = $faker->password();
        $student_opts = [
            "email" => $faker->email,
            "name" => $faker->name,
            "apellidos" => $faker->lastName,
            "password" => $pass,
            "password_confirmation" => $pass,
            "phone" => $faker->randomNumber(9),
            'nre'   => $faker->randomNumber(9),
            'domicilio' => $faker->address,
            'status' => $faker->randomElement(['ESTUDIANDO',"FCT", "CONTRATADO", "PARO"]),
            "edad" => $faker->numberBetween(16,90),
            "vehiculo" => $faker->boolean()
        ];

        //When
        $this->actingAs(Teacher::isAdmin(0)->first()->user);
        $this->visit(route('student.edit',$student->id))
            ->type($student_opts["email"],"email")
            ->type($student_opts["name"],"name")
            ->type($student_opts["apellidos"],"apellidos")
            ->type($student_opts["password"],"password")
            ->type($student_opts["password_confirmation"],"password_confirmation")
            ->type($student_opts["phone"],"phone")
            ->type($student_opts["nre"],"nre")
            ->type($student_opts["domicilio"],"domicilio")
            ->type($student_opts["edad"],"edad")
            ->type($student_opts["vehiculo"],"vehiculo")
            ->select($student_opts["status"],"status")
            ->press("Editar");

        //Then
//        $this->seeInDatabase('users',["email" => $student_opts["email"],"name" => $student_opts["name"],"phone" => $student_opts["phone"],"is_active" => 1])
//            ->seeInDatabase("students",
//                [
//                    "status" => $student_opts["status"],
//                    "edad" => $student_opts["edad"],
//                    "nre" => $student_opts["nre"],
//                    "apellidos" => $student_opts["apellidos"],
//                    "domicilio" => $student_opts["domicilio"],
//                    "vehiculo" => $student_opts["vehiculo"]
//                ]
//            );

        return $student_opts;

    }


    /**
     * Prueba si puedo editar un student logueado como ese mismo student.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_student_can_edit_herself()
    {
        //Having
        $faker =  Faker::create('es_ES');
        $student = Student::Active()->inRandomOrder()->first();
        $pass = $faker->password();
        $student_opts = [
            "email" => $faker->email,
            "name" => $faker->company,
            "apellidos" => $faker->lastName,
            "password" => $pass,
            "password_confirmation" => $pass,
            "phone" => $faker->randomNumber(9),
            'nre'   => $faker->randomNumber(9),
            'domicilio' => $faker->address,
            'status' => $faker->randomElement(['ESTUDIANDO',"FCT", "CONTRATADO", "PARO"]),
            "edad" => $faker->numberBetween(16,90),
            "vehiculo" => $faker->boolean()
        ];

        //When
        $this->actingAs($student->user);
        $this->visit(route('user.settings'))
            ->type($student_opts["email"],"email")
            ->type($student_opts["name"],"name")
            ->type($student_opts["apellidos"],"apellidos")
            ->type($student_opts["password"],"password")
            ->type($student_opts["password_confirmation"],"password_confirmation")
            ->type($student_opts["phone"],"phone")
            ->type($student_opts["nre"],"nre")
            ->type($student_opts["domicilio"],"domicilio")
            ->type($student_opts["edad"],"edad")
            ->type($student_opts["vehiculo"],"vehiculo")
            ->select($student_opts["status"],"status")
            ->press("Editar");

        //Then
        $this->seeInDatabase('users',["email" => $student_opts["email"],"name" => $student_opts["name"],"phone" => $student_opts["phone"],"is_active" => 1])
            ->seeInDatabase("students",
                [
                    "status" => $student_opts["status"],
                    "edad" => $student_opts["edad"],
                    "nre" => $student_opts["nre"],
                    "apellidos" => $student_opts["apellidos"],
                    "domicilio" => $student_opts["domicilio"],
                    "vehiculo" => $student_opts["vehiculo"]
                ]
            );

        return $student_opts;

    }

    /**
     * Prueba si puedo editar un alumno logueado como alumno.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_student_cannot_edit_a_student()
    {
        //Having
        $user = Student::inRandomOrder()->first()->user;
        $student = Student::inRandomOrder()->first();

        //When
        $this->actingAs($user);
        $this->get(route("student.edit",$student->id));

        //Then
        $this->seeStatusCode(403); //403 = Forbidden
    }

    /**
     * Prueba si puedo editar un student logueado como enterprise.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_enterprise_cannot_edit_a_student()
    {
        //Having
        $user = Enterprise::inRandomOrder()->first()->user;
        $student = Student::inRandomOrder()->first();

        //When
        $this->actingAs($user);
        $this->get(route("student.edit",$student->id));

        //Then
        $this->seeStatusCode(403); //403 = Forbidden
    }

    /**
     * Prueba si puedo eliminar un alumno logueado como administrador.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_admin_can_delete_a_student()
    {

        //Having
        $user = Teacher::isAdmin(1)->inRandomOrder()->first()->user;
        $student = Student::inRandomOrder()->first();

        //When
        $this->actingAs($user);
        $this->delete(route("student.destroy",$student->id));

        //Then
        $this->notSeeInDatabase("students",$student->getAttributes()); //401 = Forbidden

    }


    /**
     * Prueba si puedo eliminar un alumno logueado como teacher.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_teacher_can_delete_a_student()
    {

        //Having
        $user = Teacher::isAdmin(0)->inRandomOrder()->first()->user;
        $student = Student::inRandomOrder()->first();

        //When
        $this->actingAs($user);
        $this->delete(route("student.destroy",$student->id));

        //Then
        $this->notSeeInDatabase("students",$student->getAttributes()); //401 = Forbidden

    }

    /**
     * Prueba si puedo eliminar un alumno logueado como ese alumno.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_student_cannot_delete_herself()
    {

        //Having
        $student = Student::inRandomOrder()->first();

        //When
        $this->actingAs($student->user);
        $this->delete(route("student.destroy",$student->id));

        //Then
        $this->seeStatusCode(403); // Forbidden
        $this->seeInDatabase("students",$student->getAttributes()); //401 = Forbidden

    }


    /**
     * Prueba si puedo eliminar un alumno logueado como alumno.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_student_cannot_delete_a_student()
    {

        //Having
        $user = Student::inRandomOrder()->first()->user;
        $student = Student::inRandomOrder()->first();

        //When
        $this->actingAs($user);
        $this->delete(route("student.destroy",$student->id));

        //Then
        $this->seeStatusCode(403); // Forbidden
        $this->seeInDatabase("students",$student->getAttributes()); //401 = Forbidden

    }


    /**
     * Prueba si puedo ver el index logueado como admin.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_admin_can_see_the_student()
    {
        //HAVING
        $student = Student::Active()->inRandomOrder()->first();

        //WHEN
        $this->actingAs(Teacher::isAdmin(1)->first()->user);
        $this->visit(route("student.index"));

        //THEN
        $this->see($student->user->name)
            ->see($student->nre)
            ->see($student->user->email)
            ->see($student->user->phone);
        $this->seeInDatabase("students",$student->getAttributes());

    }

    /**
     * Prueba si puedo ver el index logueado como teacher.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_teacher_can_see_the_student()
    {
        //HAVING
        $student = Student::Active()->inRandomOrder()->first();

        //WHEN
        $this->actingAs(Teacher::isAdmin(0)->first()->user);
        $this->visit(route("student.index"));

        //THEN
        $this->see($student->user->name)
            ->see($student->nre)
            ->see($student->user->email)
            ->see($student->user->phone);
        $this->seeInDatabase("students",$student->getAttributes());

    }


    /**
     * Prueba si puedo ver el index logueado como enterprise.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_enterprise_cannot_see_the_students()
    {
        //HAVING
        $student = Student::Active()->inRandomOrder()->first();

        //WHEN
        $this->actingAs(Enterprise::inRandomOrder()->first()->user);
        $this->get(route("enterprise.index"));

        //THEN
        $this->seeStatusCode(403); //Forbidden
        $this->seeInDatabase("students",$student->getAttributes());

    }


    /**
     * Prueba si puedo ver el index logueado como student.
     *
     *
     * @return array
     * @author Fernando Meseguer Fernández
     */
    public function test_a_student_can_see_the_students()
    {
        //HAVING
        $student = Student::Active()->inRandomOrder()->first();

        //WHEN
        $this->actingAs(Student::inRandomOrder()->first()->user);
        $this->get(route("enterprise.index"));

        //THEN
        $this->seeStatusCode(403); //Forbidden
        $this->seeInDatabase("students",$student->getAttributes());

    }



    /**
     * Prueba si puedo entrar al showlogueado como admin.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_admin_can_see_the_show_of_a_student()
    {
        //HAVING
        $student = Student::Active()->inRandomOrder()->first();

        //WHEN
        $this->actingAs(Teacher::isAdmin(1)->inRandomOrder()->first()->user);
        $this->visit(route("user.profile",$student->user->id));

        //THEN
        $this->see($student->user->name)
            ->see($student->id);
        $this->seeInDatabase('students',$student->getAttributes());
    }


    /**
     * Prueba si puedo entrar al show logueado como teacher.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_teacher_can_see_the_show_of_a_student()
    {
        //HAVING
        $student = Student::Active()->inRandomOrder()->first();

        //WHEN
        $this->actingAs(Teacher::isAdmin(0)->inRandomOrder()->first()->user);
        $this->visit(route("user.profile",$student->user->id));

        //THEN
        $this->see($student->user->name)
            ->see($student->id);
        $this->seeInDatabase('students',$student->getAttributes());
    }

    /**
     * Prueba si puedo entrar al show logueado como student.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_student_can_see_the_show_of_a_student()
    {
        //HAVING
        $student = Student::Active()->inRandomOrder()->first();

        //WHEN
        $this->actingAs(Student::inRandomOrder()->first()->user);
        $this->visit(route("user.profile",$student->user->id));

        //THEN
        $this->see($student->user->name)
            ->see($student->id);
        $this->seeInDatabase('students',$student->getAttributes());
    }


    /**
     * Prueba si puedo entrar al show logueado como enterprise.
     *
     *
     * @return void
     * @author Fernando Meseguer Fernández
     */
    public function test_a_enterprise_can_see_the_show_of_a_student()
    {
        //HAVING
        $student = Student::Active()->inRandomOrder()->first();

        //WHEN
        $this->actingAs(Enterprise::inRandomOrder()->first()->user);
        $this->visit(route("user.profile",$student->user->id));

        //THEN
        $this->see($student->user->name)
            ->see($student->id);
        $this->seeInDatabase('students',$student->getAttributes());
    }

}
