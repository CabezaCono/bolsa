<?php

/**
 *
 * HomeController
 *
 * Gestiona el inicio de los usuarios
 */
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use \App\TeacherValidation;
use \App\Student;
use \App\Enterprise;
use Faker\Factory as Faker;

/**
 * Class HomeController
 *
 * Getsiona el inicio de los usuarios
 * @package App\Http\Controllers
 */

class HomeController extends Controller
{
    /**
     * Constructor
     *
     * Contiene un middleware que impide que usuarios no logeados puedan acceder a sus secciones.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra el inicio de la app
     *
     * Dintingue entre Administrador,profesor, estudiante y empresa
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        switch (auth()->user()->rol) {
            case 'is_admin':
                return $this->indexAdmin();
                break;

            case 'is_teacher':
                return $this->indexTeacher();
                break;

            case 'is_student':
                return redirect()->route("offers.index");
                break;

            case 'is_enterprise':
                return $this->indexEnterprise();
                break;
            
            default:
                return redirect()->route("index");
                break;
        }
        
    }

    /**
     * indexAdmin
     *
     * Muestra el incio de la aplicacion al administrador
     *
     * @var App\TeacherValidation $allValidations muestra todos los usuarios validados
     * @var object $currentUserValidations validacionees pendientes
     * @return mixed
     */

    public function indexAdmin(){
        
        $allValidations = TeacherValidation::orderBy("created_at","desc")->take(7)->get();
        $currentUserValidations = auth()->user()->teacher->validations->take(7);
        return view("index.admin",compact("allValidations","currentUserValidations"));
    }

    /**
     * indexTeacher
     *
     * Muestra el inicio de la aplicacion para los profesores
     *
     * @var App\Faker $faker contiene datos falsos
     * @var object $quote citas aleatorias
     * @var App\Student $stundetCount contador de estudiantes no activos
     * @var App\Enteprise $enterpriseCount contador de empresas no activas
     *
     * @return mixed
     */

    public function indexTeacher(){
        $faker = Faker::create("es_ES");
        $quote = $faker->randomElement(config("quotes"));
        $studentCount = Student::NoActive()->count();
        $enterpriseCount = Enterprise::NoActive()->count();
        return view("index.teacher",compact("studentCount","enterpriseCount","quote"));   
    }

    /**
     * Inicio de la aplicacion para estudiantes
     * @return mixed
     */

    public function indexStudent(){
        return view("index.student");
    }

    /**
     * Inicio de la aplicación para empresas
     * @return mixed
     */

    public function indexEnterprise(){

        return view("index.enterprise");
    }
}
