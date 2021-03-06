<?php
/**
 * Controlador Estudiante
 */

namespace App\Http\Controllers;

/** REQUEST */
use Illuminate\Http\Request;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;

/** MODELOS */
use App\User;
use App\Student;
use App\Cicle;

/** MAILS */
use App\Mail\newRegisteredUser;
use Illuminate\Support\Facades\Mail;

/** OTROS */
use Illuminate\Support\Facades\Session;

/**
 * Class StudentController
 *
 * Gestiona la información relativa a los usuarios estudiantes
 * @package App\Http\Controllers
 */


class StudentController extends Controller {

    /**
     * Index de estudiantes
     *
     * Muestra un listado con todos los estudiantes activos
     *
     * @param  Request $request trae los datos de los filtros desde la vista
     * @var Student $students estudiantes
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $students= Student::Search($request)->Active()->get();
        return view("student.index", compact("students"));
    }

    /**
     * Muestra el formulario para crear un nuevo estudiante
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $this->authorize('create',Student::class);
        $cicles = get_model_selectable_by_name(Cicle::all());
        return view("student.create", compact("cicles"));
    }

    /**
     * Almacena un estudiante en la BBDD
     *
     * @param StudentStoreRequest|Request $request validación de datos del formulario
     * @return \Illuminate\Http\Response
     */
    public function store(StudentStoreRequest $request) {
        //Crear alumno 1º
        $user = new User($request->only(["email","password","name"]));
        $user->phone = $request->get("phone");
        $user->is_active = 0;
        $user->save();

        $student = $user->student();

        $opts = [
            "apellidos" => $request->get("apellidos"),
            "nre" => $request->get("nre"),
            "vehiculo" => $request->get("vehiculo"),
            "domicilio" => $request->get("domicilio"),
            "status" => $request->get("status"),
            "edad" => $request->get("edad")
        ];
        if($request->get("vehiculo") == null) { //Si la contraseña es nula no se cambia
            $opts["vehiculo"] = 0;
        }

        $student->create($opts);

        Session::flash('message', 'Estudiante agregado correctamente');

        Mail::to($user->email)->send(new newRegisteredUser($user)); 

        return redirect()->route("student.index");
    }

    /**
     * Muestra un estudiante
     *
     * @param  \App\Student  $student Estudiante que será mostrado
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student) {
        $this->authorize('view',$student);
        return view("student.show", compact("student"));
    }

    /**
     * Muestra el formulario para le edición de un estudiante
     *
     *
     * @param  \App\Student  $student estudiante a ser editado
     * @var Cicle $cicles ciclos para relacionar el estudiante
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student) {
        $this->authorize('update',$student);
        //Paso el id a sesion para que la validación excluya este id cuando se vaya a editar
        Session::flash('user_id', $student->user->id);
        //mejorar para que en la vista coja la relacion
        $cicles = get_model_selectable_by_name(Cicle::all());
        return view("student.edit", compact("student","cicles"));
    }

    /**
     * Actualiza el estudiante en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request  datos validados del estudiante, vienen del formulario.
     * @param  \App\Student  $student estudiante a ser editado
     * @return \Illuminate\Http\Response
     */
    public function update(StudentUpdateRequest $request, Student $student) {

        $this->authorize('update',$student);
        $user = User::findOrFail($student->user_id);
        $student = Student::findOrFail($student->id);

        $optsUser = [
            "email" => $request->get("email"),
            "name" => $request->get("name"),
        ];
        $user->phone = $request->get("phone");

        $optsStudent = [
            "apellidos" => $request->get("apellidos"),
            "nre" => $request->get("nre"),
            "vehiculo" => $request->get("vehiculo"),
            "domicilio" => $request->get("domicilio"),
            "edad" => $request->get("edad"),
        ];
        $student->status = $request->get("status");

        if($request->get("password") != null) { //Si la contraseña es nula no se cambia
            $optsUser["password"] = $request->get("password");
        }
        if($request->get("vehiculo") == null) { //Si la contraseña es nula no se cambia
            $optsStudent["vehiculo"] = 0;
        }

        $user->fill($optsUser);
        $student->fill($optsStudent);

        $user->save();
        $student->save();

        Session::flash('message', 'Estudiante editado correctamente');
//        $respuesta = true;
        return redirect()->back();
    }

    /**
     *Elimina un estudiante
     *
     * @link('soft-delete')
     *
     * @param  \App\Student  $student estudinat a ser eliminado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student) {
        $this->authorize('delete',$student);
        $user = User::findOrFail($student->user_id);

        $student->delete();
        $user->delete();

        return redirect()->route("student.index");
    }

    /**
     * Inactive
     *
     * Devuelve los estudiantes que han sido 'eliminados'  o no validados.
     * @return mixed
     */

    public function inactive()
    {
        $students = Student::NoActive()->get();
        return view("student.inactive", compact("students"));
    }

    /**
     * Nuevo ciclo
     *
     * Función que genera los ciclos del estudiante
     *
     * @param Request $request datos del ciclo
     * @param Student $student estudiante al que se le asociaran
     * @return mixed
     */

    public function newCicle(Request $request, Student $student)
    {
        $student->cicles()->attach($request->get("cicle_id"), ['promocion' => $request->get("promocion"),"finalizado" => ($request->get("finalizado"))?"1":"0"]);
        return redirect()->back();
    }

    /**
     *
     * Borrar Ciclo
     * @param Student $student estudiante al que se le borrará la relación con el ciclo
     * @param Cicle $cicle ciclo al ser eliminado
     * @return mixed
     */

    public function delCicle( Student $student,Cicle $cicle)
    {
        $student->cicles()->detach($cicle->id);
        return redirect()->back();
    }
 
}