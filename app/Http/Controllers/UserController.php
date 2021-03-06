<?php
/**
 * Controlador de usuario
 */

namespace App\Http\Controllers;

/** REQUEST */
use Illuminate\Http\Request;

/** MODELOS */
use App\User;
use App\Student;
use App\Teacher;
use App\Enterprise;
use App\Offer;
use App\Cicle;
use App\TeacherValidation;

/** MAILS */
use Illuminate\Support\Facades\Mail;
use App\Mail\ValidationOk;

/** OTROS */
use Illuminate\Support\Facades\Session;

/**
 * Class UserController
 *
 * La clase usuario gestiona la información relativa a los usuarios, sin importar su tipo
 * @package App\Http\Controllers
 */


class UserController extends Controller
{

    /**
     * Inactive
     * devuelve un listado con todos los usuarios inactivos.
     *
     * @var Student $students estudiantes no activos
     * @var Teacher $teachers profesores no activos
     * @var Enterprise $enterprise empresas no activas
     *
     *
     * @return mixed
     */

    public function inactive()
    {

        $students = Student::NoActive()->get();
        $teachers = Teacher::NoActive()->get();
        $enterprises = Enterprise::NoActive()->get();
        $allValidations = TeacherValidation::orderBy("created_at","desc")->take(10)->get();
        $currentUserValidations = auth()->user()->teacher->validations->take(10);
        return view("inactive.index",compact("students","teachers","enterprises","allValidations","currentUserValidations"));
    }

    /**
     *
     * Cambiar Activación
     *
     * Gestona el estado de la activación del usuario
     * @param User $user usuario  al que se le realizará el cambio
     * @return mixed
     */
    public function changeActive(User $user) {

        //Si el usuario esta activo
        if ($user->rol == "is_teacher" && auth()->user()->rol == "is_teacher"){
            return redirect()->back();
        }else {
            if ($user->is_active == 1) {

                //Actualizo su active y borro el registro de validations
                $user->is_active = 0;
                $user->save();
                $user->validatedBy()->create(["teacher_id" => auth()->user()->teacher->id, "user_id" => $user->id, "action" => "DEL"]);
            } else {

                //Creo el registro de validations
                $user->validatedBy()->create(["teacher_id" => auth()->user()->teacher->id, "user_id" => $user->id, "action" => "ADD"]);

                //Por aquí el campo action para la tabla validate

                $user->validatedBy->save();
                $user->is_active = 1;
                $user->save();
                Mail::to($user->email)->send(new ValidationOk($user));
            }
            //Guardo cambios hechos en user


            return redirect()->back();
        }
    }

    /**
     * Cambiar el estado a un grupo
     *
     * Este método se basa en ChangeActive para cambiar el estado en lotes.
     * @param Request $request usuarios que sufiran en cambio
     * @return mixed
     */

    public function changeSelected(Request $request) {
        if(!empty($request->get("selected"))) {
            foreach ($request->get("selected") as $id) {
                $user = User::findorfail($id);
                $this->changeActive($user);
            }
        }else{
            Session::flash('message', 'No has seleccionado a nadie');
        }

        return redirect()->back();
    }

    /**
     *
     * Perfil
     *
     * Devuelve la vista del perfil de cada usuario según si tipología.
     *
     * @param User $user usuario
     * @return mixed
     */

    public function profile(User $user) {

        switch ($user->rol) {
            case 'is_admin':
                $teacher = $user->teacher;
                return view('teachers.show', compact('teacher'));
                break;

            case 'is_teacher':
                $teacher = $user->teacher;
                return view('teachers.show',compact('teacher'));
                break;

            case 'is_student':
                $student = $user->student;
                return view('student.show', compact('student'));
                break;

            case 'is_enterprise':
                $offers = $user->enterprise->offers;
                $enterprise = $user->enterprise;
                return view('enterprise.show',compact('enterprise',"offers"));
                break;
            
            default:
                return route('home');
                break;
        }
    }

    /**
     * Mis ofertas
     *
     * Devuelve las ofertas del usuario que este logeado en la web.
     * @return mixed
     */

    public function myoffers()
    {

        $user = auth()->user();
        switch ($user->rol) {
            case 'is_admin':
                $offers = $user->teacher->offers;
                return view('teachers.myoffers', compact('offers'));
                break;

            case 'is_teacher':
                $offers = $user->teacher->offers;
                return view('teachers.myoffers', compact('offers'));
                break;

            case 'is_student':
                $subscriptions = get_childs($user->student->subscriptions,"offer");
                $acepted = get_childs($user->student->selectionsPositive,"offer");
                $denied = get_childs($user->student->selectionsNegative,"offer");
                $pending = get_childs($user->student->selectionsPending,"offer");

                return view('student.myoffers', compact('subscriptions',"acepted","denied","pending"));
                break;

            case 'is_enterprise':
                $myoffers = $user->enterprise->offers;
                return view('enterprise.myoffers',compact("myoffers"));
                break;

            default:
                return redirect()->route('home');
                break;
        }
    }

    public function settings()
    {
        $user = auth()->user();
        switch ($user->rol) {
            case 'is_admin':
                $teacher = $user->teacher;
                $this->authorize('update',$user->teacher);
                Session::flash('user_id', $user->id);
                $cicles = get_model_selectable_by_name(Cicle::all());
                return view('teachers.edit', compact('teacher', 'cicles'));
                break;

            case 'is_teacher':
                $teacher = $user->teacher;
                $this->authorize('update',$user->teacher);
                Session::flash('user_id', $user->id);
                $cicles = get_model_selectable_by_name(Cicle::all());
                return view('teachers.edit', compact('teacher', 'cicles'));
                break;

            case 'is_student':
                $student = $user->student;
                $this->authorize('update',$user->student);
                Session::flash('user_id', $user->id);
                $cicles = get_model_selectable_by_name(Cicle::all());
                return view("student.edit", compact("student","cicles"));
                break;

            case 'is_enterprise':
                $empresa = $user->enterprise;
                $this->authorize('update',$user->enterprise);
                Session::flash('user_id', $user->id);
                return view('enterprise.edit',compact('empresa'));
                break;

            default:
                return redirect()->route('home');
                break;
        }
    }
}
