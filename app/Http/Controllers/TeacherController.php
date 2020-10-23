<?php

/**
 * Controlador Profesores
 */

namespace App\Http\Controllers;

/** REQUEST */
use Carbon\Carbon;
use Clarkeash\Doorman\Models\Invite;
use Illuminate\Http\Request;
use App\Http\Requests\TeacherStoreRequest;
use App\Http\Requests\TeacherUpdateRequest;

/** MODELOS */
use App\Teacher;
use App\User;
use App\Cicle;

/**  MAILS*/
use App\Mail\TeacherInvitation;
use App\Mail\newRegisteredUser;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

/** OTROS */
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Session;

/**
 * Class TeacherController
 *
 * Gestiona la información relativa a los usuarios que son profesores
 *
 * @package App\Http\Controllers
 */
class TeacherController extends Controller
{
    /**
     *Muestra un listado de los profesores activos
     *
     *@param Request $request datos para los filtros
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $teachers = Teacher::Search($request)->Active()->get();
        return view('teachers.index', compact('teachers', 'request'));
    }


    /**
     * Muestra el formulario para crear un nuevo ciclo
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',Teacher::class);
        $cicles = get_model_selectable_by_name(Cicle::all());
        return view('teachers.create', compact("cicles"));
    }

    /**
     *Almacena un nuevo ciclo en la base de datos
     *
     * @param  \Illuminate\Http\Request $request datos del ciclo, validados.
     * @var User $user hace referencia al modelo de usuario del que extiende Teacher.
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherStoreRequest $request)
    {

        //dd($request->only(["email","password","name","phone"]));
        if(\Doorman::check($request->get("code"),$request->get("email"))){
            $user = new User($request->only(["email","password","name"]));
            $user->phone = $request->get("phone");
            if (auth()->check()){
                if(auth()->user()->rol == "is_admin"){
                    $user->is_active = 1;
                }
            }else{
                $user->is_active = 0;
            }

            $user->save();

            Mail::to($user->email)->send(new newRegisteredUser($user));

            $teacher = $user->teacher();


            $opts = [
                "apellidos" => $request->get("apellidos"),
                "nrp_expediente" => $request->get("nrp_expediente"),
                "is_admin" => $request->get("is_admin")
            ];

            if($teacher->create($opts)){
                \Doorman::redeem($request->get("code"),$request->get("email"));
                Session::flash('message', 'Profesor agregado correctamente');
                return redirect()->route("teacher.index");
            }else {
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }

    /**
     * Muestra los datos de un profesor
     *
     * @param  \App\Teacher $teacher profesor al ser mostrado
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        $this->authorize('view',$teacher);
        return view('teachers.show', compact('teacher'));
    }

    /**
     *Muestra el formulario para editar un profesor
     *
     * @param  \App\Teacher $teacher Profesor al ser editado
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        $this->authorize('update',$teacher);
        //$cicles = $teacher->find($teacher->id)->cicles()->get();

        Session::flash('user_id', $teacher->user->id);
        $cicles = get_model_selectable_by_name(Cicle::all());

        return view('teachers.edit', compact('teacher', 'cicles'));
    }

    /**
     *Actualiza un profesor en la base de datos
     *
     * @param  \Illuminate\Http\Request $request datos del profesor, validados.
     * @param  \App\Teacher $teacher profesor a ser editado
     *
     * @return \Illuminate\Http\Response
     */
    public function update(TeacherUpdateRequest $request, Teacher $teacher)
    {
        $this->authorize('update',$teacher);
        $teacher->cicles()->updateExistingPivot($request->get("cicle_id"),['promocion' => $request->get("promocion")]);
        $teacher->user->fill($request->only(["email", "password", "name", "phone"]));
        $teacher->user->save();
        ($request->get("is_admin")) ? $is_admin = 1 : $is_admin = 0;
        $opts = [
            "apellidos" => $request->get("apellidos"),
            "nrp_expediente" => $request->get("nrp_expediente"),
            "is_admin" => $request->get("is_admin")
        ];
        $teacher->fill($opts);
        $teacher->save();
        Session::flash('message', 'Profesor editado correctamente');
        return redirect()->back();
    }

    /**
     *Elimina un profesor de la base de datos
     *
     *
     * @param  \App\Teacher $teacher profesor que pasara a inactivo.
     * @var User $user de nuevo borramos primero el usuario y despues los datos asociados a éste.
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        $this->authorize('delete',$teacher);
        //Borra el usuario
        $teacher->user()->delete();

        //Borra el profesor
        $teacher->delete();

        return redirect()->route("teacher.index");
    }

    /**
     * Inactive
     * Devuelve un listado de los profesores que estan inactivos, bien porque han sido eliminados o porque no se han validado todavia.
     * @return mixed
     */

    public function inactive()
    {
        $teachers = Teacher::NoActive()->get();
        return view("teachers.inactive", compact("teachers"));
    }

    /**
     * Devuelve un listado con als invitaciones enviadas
     * @var Invite $invites invitaciones
     * @return mixed
     */

    public function invitations()
    {
        Carbon::setLocale("es");
        $invites = Invite::all();
        return view("admin.invitations",compact("invites"));
    }

    /**
     * Cancelar invitación
     *
     * Borar una invitación
     * @param Invite $invitation invitación a ser cancelada
     * @return mixed
     */

    public function cancelInvitation(Invite $invitation)
    {
        $invitation->delete();
        return redirect()->route("teacher.invitations");
    }

    /**
     * Genera una invitación
     * @param Request $request datos de la invitación
     * @return mixed
     *
     */

    public function invite(Request $request)
    {

        $date = Carbon::now('UTC')->addDays(1);
        $doorman =  \Doorman::generate()->for($request->get("email"))->expiresOn($date)->make()[0]->code;
        Mail::to($request->get("email"))->send(new TeacherInvitation($doorman,$request->get("email")));

        return redirect()->route("teacher.invitations");

    }

    /**
     * Limpiar invitaciones
     *
     * Limpia las invitaicones que no han sido utilizadas
     * @return mixed
     */

    public function cleanInvitations()
    {
        Invite::useless()->delete();
        return redirect()->route("teacher.invitations");
    }

    /**
     *
     * Crea un ciclo nuevo
     * @param Request $request datos del ciclo
     * @param Teacher $teacher profesor al que se asociará el ciclo
     * @return mixed
     *
     */

    public function newCicle(Request $request, Teacher $teacher)
    {
        $teacher->cicles()->attach($request->get("cicle_id"), ['promocion' => $request->get("promocion")]);
        return redirect()->back();
    }

    /**
     * Borrar ciclo
     * @param Teacher $teacher profesor al que se le eliminará el ciclo
     * @param Cicle $cicle ciclo a ser eliminado
     * @return mixed
     */

    public function delCicle(Teacher $teacher,Cicle $cicle)
    {
        $teacher->cicles()->detach($cicle->id);
        return redirect()->back();
    }
}
