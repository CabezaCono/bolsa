<?php

/**
 * Controlador de Ciclos
 *
 * Este controlador permite la gestión de la informacón relativa a los Ciclos
 */

namespace App\Http\Controllers;

/**
 *
 * REQUEST
 *
 * Obtiene datos de formularios
 *
 */
use Illuminate\Http\Request;

/**
 * Requests de validacion
 *
 * Valida datos basandose en las normas de estos ficheros
 */
use App\Http\Requests\EnterpriseStoreRequest;
use App\Http\Requests\EnterpriseUpdateRequest;

/**
 * MODELOS
 *
 * @see  App\Offer
 * @see App\Enterprise
 * @see App\User
 *
 */
use App\Offer;
use App\Enterprise;
use App\User;

/**
 * MAILS
 *
 * Hace uso de los helpers de laravel para enviar emails
 *
 */
use App\Mail\newRegisteredEnterprise;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

/** OTROS */
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Session;

/**
 * Class EnterpriseController
 * Gestiona la información relativa a las Empresas.
 * @package App\Http\Controllers
 *
 *
 */

class EnterpriseController extends Controller
{
    /**
     * Muestra el listado de empresas
     *
     * Muestra el listao de empreas activas
     *
     * @param \Illuminate\Http\Request  $request  contiene un criterio para filtro.
     * @var  App\Enterprise $empresas listado de empresas
     * @return void
     *
     */
    public function index(Request $request)
    {
        $empresas= Enterprise::Search($request)->Active()->get();
        return view('enterprise.index', compact('empresas','request'));
    }

    /**
     * Muesta el formulario para crear una nueva empresa
     *
     *
     * @return void
     *
     */
    public function create()
    {
        $this->authorize('create',Enterprise::class);
        return view('enterprise.create');
    }

    /**
     * Crea una nueva empresa en la BBDD
     *
     * Para la creación de una nueva empresa primero se crea un usuario, el cual tendrá las propiedades
     * necesarias para ser una empresa. Una vez creado el usuario se almacena una empreas en él.
     *
     * @param  \Illuminate\Http\Request  $request datos del formulario
     * @var \App\User $user usuario-empresa
     *
     *
     * @return mixed
     */
    public function store(Request $request)
    {

        $user= new User($request->only(["name","email","password"]));
        $user->phone = $request->get("phone");
        $user->is_active = false;
        $user->save();

        $user->enterprise()->create($request->only(["descripcion","sociedad","cif","fax","fecha_fundacion","web","pais","ciudad","min_empleados","max_empleados"]));

        if($user->enterprise->save()){
            Session::flash('message', 'Empresa agregada correctamente');
            /*
             * Email, sólo nesitamos darle el email  + datos del usuario.
             */
            Mail::to($user->email)->send(new newRegisteredEnterprise($user));
            if (Auth::check()){
                return redirect()->back();
            }else{
                return redirect()->route("login");
            }
        }else {
            return "ERROR";
        }
    }

    /**
     * Muestra una empresa
     *
     * Muestra una empresa y sus ofertas
     *
     * @param  \App\Enterprise  $enterprise empresa
     * @var \App\Offer $offers ofertas de la empresa
     * @return mixed
     */
    public function show(Enterprise $enterprise)
    {
        $this->authorize('view',$enterprise);
        $offers = $enterprise->offers;
        return view('enterprise.show',compact('enterprise',"offers"));
    }

    /**
     * Muestra el formulario para editar una empresa
     *
     * @param  \App\Enterprise  $enterprise
     * @var \App\User $user usuario-empresa, es lo que realmente se modifica
     * @return Empresa
     */
    public function edit(Enterprise $enterprise)
    {
        $this->authorize('update',$enterprise);
        $empresa = $enterprise;
        Session::flash('user_id', $enterprise->user->id);

        return view('enterprise.edit',compact('empresa'));
    }

    /**
     * Actualiza los datos de la empresa
     *
     * @param  \Illuminate\Http\Request  $request datos del forumlario, filtrados por validador
     * @param  \App\Enterprise  $enterprise empresa ser editada
     * @return mixed
     */
    public function update(EnterpriseUpdateRequest $request, Enterprise $enterprise)
    {
        $this->authorize('update',$enterprise);
        $enterprise->user->fill($request->only(["name","email"]));
        $enterprise->user->phone = $request->get("phone");
        $enterprise->user->save();
        $enterprise->fill($request->only(["descripcion","sociedad","cif","fax","fecha_fundacion","web","pais","ciudad","min_empleados","max_empleados"]));

        if($enterprise->save()){
            Session::flash('message', 'Empresa editada correctamente');
            return redirect()->back();

        }else {
            return "Error en la Edicion";
        }
    }

    /**
     * Elimina la empresa
     *
     * Marca esta empresa como 'eliminada' añadiendo la fecha al campo apropiado
     * @link('soft-delete')
     *
     * @param  \App\Enterprise  $enterprise empresa a ser eliminada
     * @return mixed
     */
    public function destroy(Enterprise $enterprise)
    {
        $this->authorize('delete',$enterprise);
        $enterprise->user()->delete();
        $enterprise->delete();
        Session::flash('message', "La Empresa". $enterprise->user()->name . " ha sido eliminida");
        return redirect()->route("enterprise.index");
    }

    /**
     * Muesta las empreas inactivas o borradas
     *
     * Muestra las empresas que han sido desactivadas con el metodo destroy()
     *
     * @var \App\Enterprise $enterprises Empreas eliminadas
     * @return mixed
     */

    public function inactive()
    {
        $enterprises = Enterprise::NoActive()->get();
        return view("enterprise.inactive", compact("enterprises"));
    }

}
