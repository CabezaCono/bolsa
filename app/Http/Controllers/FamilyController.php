<?php
/**
 * Controlador de Familias profesionales
 *
 * Gestionala información relativa a familias profesionales
 */

namespace App\Http\Controllers;

/** REQUEST */
use Illuminate\Http\Request;
use App\Http\Requests\ProfessionalFamilyStoreRequest;
use App\Http\Requests\ProfessionalFamilyUpdateRequest;
use Carbon\Carbon;

/** MODELOS */
use App\Family;
use App\Offer;

/** MAILS */

/** OTROS */
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection;
/**
 * Class FamilyController
 * Gestiona la información relativa a las familias profesionales.
 * @package App\Http\Controllers
 *
 *
 */

class FamilyController extends Controller
{
    /**
     * Muestra todas las familias profesionales
     *
     * Muestra todas las familias profesionales ordenadas en base al los datos de request
     *
     * @param \Illuminate\Http\Request $request datos para el orden
     * @var App|Family $profesionalfamilys listado de las familias
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        $profesionalfamilys = Family::Name($request)->orderBy("id","asc")->get();

        return view("family.index",compact("profesionalfamilys","request"));
    }

    /**
     *Muestra el formulario para crear una familia
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',Family::class);
        return view('family.create');
    }

    /**
     * Almacena una nueva familia profesional
     *
     * Tras valiar los datos con el Request pertinente almacena en la bbdd la nueva familia
     *
     * @param  \Illuminate\Http\Request  $request
     * @var App\Family $family familia
     * @return \Illuminate\Http\Response
     */
    public function store(ProfessionalFamilyStoreRequest $request)
    {
        $this->authorize('create',Family::class);
        $family = new Family(["name" => $request->get("name")]);
        $family->save();
        Session::flash('message', 'Familia profesional agregada correctamente');
        return redirect()->route("family.index");
    }

    /**
     * Muesta una familia
     *
     * @param  \App\Family  $family familia a mostrar
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family)
    {
        $this->authorize('view',$family);
        return view("family.show",compact("family"));
    }

    /**
     * Muesta el formulario para editar una familia
     *
     * @param  \App\Family  $family familia a editar
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family)
    {
        $this->authorize('update',$family);
        return view("family.edit",compact("family"));
    }

    /**
     * Actualiza una familia
     *
     * Valida los datos del formulario en base al Request apropiado, luego actualiza los datos en la bbdd
     *
     * @param  \Illuminate\Http\Request  $request datos del formulario
     * @param  \App\Family  $family familia a ser editada
     * @return \Illuminate\Http\Response
     */
    public function update(ProfessionalFamilyUpdateRequest $request, Family $family)
    {
        //dd($family);
        $this->authorize('update',$family);
        $family->fill(["name" => $request->get("name")]);
        $family->save();
        Session::flash('message', 'Familia profesional editada correctamente');

        return redirect()->route("family.index");
    }

    /**
     * Elimina una familia de la bbdd
     * @link('soft-delete')
     *
     * @param  \App\Family  $family familia a ser borrada
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family)
    {
        $this->authorize('delete',$family);
        $family->delete();
        Session::flash('message', 'La familia '.$family->nombre.' ha sido eliminada');
        return redirect()->route("family.index");
    }

    public function getCiclesByFamilyId(Family $family) {
       return json_encode($family->cicles);
    }
}
