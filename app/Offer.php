<?php
/**
 *
 * Modelo de Oferta
 *
 * oferta
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;

/**
 * Class Offer
 * Gestiona la información de las relaciones en bbdd y filtros de búsqueda.
 * @package App
 */

class Offer extends Model
{

    /**
     * Filliable
     *
     *  Datos que Eloquent puede tratar sobre el objeto
     * @var array
     */
    protected $fillable =[
        'requirements', 'recommended', 'title', 'work_day', 'schedule', 'contract', 'start_date', "description", "salary", "student_number", "family_id",
    ];

    /** RELACIONES **/

    /**
     * User
     *
     * Una oferta pertenece a un usaurio
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Empresa
     *
     * una oferta pertenece a una empresa
     * @return mixed
     */

    public function enterprise()
    {
        return $this->belongsTo('App\Enterprise');
    }

    /**
     * Familia
     *
     * Una oferta pertenece a una familia
     * @return mixed
     *
     */
    public function family() {
        return $this->belongsTo('App\Family');
    }

    /**
     * Selections
     *
     * Una oferta puede tener varios seleccionados
     * @return mixed
     */

    public function selections()
    {
        return $this->hasMany('App\OfferSelection');
    }

    /**
     * Una oferta puede tener varios seleccionados
     * @return mixed
     */

    public function selectionsPositive()
    {
        return $this->hasMany('App\OfferSelection')->where("answer","1");
    }
    /**
     * Una oferta puede tener varios seleccionados
     * @return mixed
     */

    public function selectionsPending()
    {
        return $this->hasMany('App\OfferSelection')->where("answer","2");
    }
    /**
     * Una oferta puede tener varios seleccionados
     * @return mixed
     */


    public function selectionsNegative()
    {
        return $this->hasMany('App\OfferSelection')->where("answer","0");
    }
    /**
     * Una oferta puede tener varios suscritos
     * @return mixed
     */


    public function subscriptions()
    {
        return $this->hasMany('App\OfferSubscription');
    }





    /** GETTERS **/

    /**
     * getFollowedByAuthAttribute
     *
     * Obtiene el tipo de usuario
     *
     * @return bool
     */
    public function getFollowedByAuthAttribute()
    {

        if (!$this->selected_by_auth | !$this->subscribed_by_auth) {
            return false;
        } else {
            return true;
        }

    }

    /**
     * getSelectedByAuthAttribute
     *
     * Obtiene los seleccionados por tipo de usuario, en este caso estudiante.
     *
     * @return bool
     */

    public function getSelectedByAuthAttribute()
    {
        if (auth()->user()->rol != "is_student") {
            return false;
        } else {
            $selected = OfferSelection::where("offer_id", $this->id)->where("student_id", auth()->user()->student->id)->get();
            if ($selected->isEmpty()) {
                return false;
            } else {
                return true;
            }
        }
    }

    /**
     * getconfirmdSelectionByAuthAttribute
     *
     * Devuelve el id del  estudiante que han confirmado
     * @return mixed
     */

    public function getConfirmedSelectionByAuthAttribute()
    {
        if (auth()->user()->rol != "is_student") {
            return false;
        } else {
            $selected = OfferSelection::where("offer_id", $this->id)->where("student_id", auth()->user()->student->id)->where("answer","1")->first();
            if (empty($selected)) {
                return false;
            } else {
                return $selected->id;
            }
        }
    }

    /**
     * getPendingSelectionByAuthAttribute
     *
     * Devuelve el id del  estudiante que tiene pendiente la confirmación
     * @return mixed
     */


    public function getPendingSelectionByAuthAttribute()
    {
        if (auth()->user()->rol != "is_student") {
            return false;
        } else {
            $selected = OfferSelection::where("offer_id", $this->id)->where("student_id", auth()->user()->student->id)->where("answer","2")->first();
            if (empty($selected)) {
                return false;
            } else {
                return $selected->id;
            }
        }
    }

    /**
     *
     * getDeniedSelectionByAuthAttribute
     *
     * Devuelve el ID de los estudiantes que han denegado la oferta
     *
     * @return bool
     */

    public function getDeniedSelectionByAuthAttribute()
    {
        if (auth()->user()->rol != "is_student") {
            return false;
        } else {
            $selected = OfferSelection::where("offer_id", $this->id)->where("student_id", auth()->user()->student->id)->where("answer","0")->first();
            if (empty($selected)) {
                return false;
            } else {
                return $selected->id;
            }
        }
    }

    /***
     * getSuscribedByAuthAttribute
     *
     * Duelve verdadero o falso según si el usuario esta suscrito, o no, a la oferta.
     * @return bool
     */

    public function getSubscribedByAuthAttribute()
    {
        if (auth()->user()->rol != "is_student") {
            return false;
        } else {
            $subscribbed = OfferSubscription::where("offer_id", $this->id)->where("student_id", auth()->user()->student->id)->get();
            if ($subscribbed->isEmpty()) {
                return false;
            } else {
                return true;
            }
        }
    }


    /** SCOPES **/

    /**
     *
     * FamilySearch
     *
     * Busca por familia
     * @param $query consulta
     * @param $family segun el criterio familai
     * @return mixed
     */

    public function scopeFamilySearch($query, $family) {
        if(intval($family) > 0){
            return $query->where("family_id", "$family");
        }
        return $query;
    }

    /**
     * Palabra
     *
     * Busca por una palabra
     * @param $query consulta
     * @param $search palabra por la que se busca en los campos titulo, descripción y dia de trabajo.
     */

    public function scopeWordSearch($query, $search) {
        $query->orWhere('title', 'like', "%".$search."%")
              ->orWhere("description", "like", "%$search%")
              ->orWhere('work_day', 'like', "%".$search."%");
    }

    /**
     * Fecha
     * Busca  por fecha
     * @param $query consulta
     * @param $date_add fecha
     * @return mixed
     */

    public function scopeDateSearch($query, $date_add) {

        if($date_add == null){  // Validación de "start_date"
            $filterDate = (Offer::select("start_date")->orderBy("start_date", "ASC")->first())->start_date;
        } else{
            $date = Carbon::now();
            $filterDate = $date->subDay(array_pop($date_add))->toDateString();
        }

        return $query->where("start_date", ">=", "$filterDate");

    }

    /**
     * Contract
     * Busca por tipo de contrato
     * @param $query consulta
     * @param $contrato tipo de contrato
     * @return mixed
     */

    public function scopeContractSearch($query, $contrato) {
        if($contrato == null)   // Validación de "contact"
            $contrato = config("arrayData")["offerContract"];

        return $query->whereIn("contract", $contrato);
    }

    /**
     * Dias de trabajo
     *
     * Busca en base a los dias de trabajo
     * @param $query consulta
     * @param $work_day dias de trabajo
     * @return mixed
     */

    public function scopeWorkDaySearch($query, $work_day) {
        if($work_day == null)   // Validación de "work_day"
            $work_day = config("arrayData")["offerWork_Day"];

        return $query->whereIn("work_day", $work_day);
    }

    /**
     * Salario
     * Busca por salario
     * @param $query consulta
     * @param $salario salario
     * @return mixed
     *
     */

    public function scopeSalarySearch($query, $salario) {
        
        if($salario == null){
            $maxSalary = Offer::max("salary");
            $salario[0] = 0;
            $salario[1] = $maxSalary;
        } else
            $salario =  explode(";", $salario);

        return $query->where("salary",">=", $salario[0])
                     ->where("salary","<=", $salario[1]);
    }

    /**
     * Busqueda por por todos los campos anteriores
     * @param $query consulta
     * @param Request $request datos para comparar
     * @return mixed
     */

    public function scopeSearch($query, Request $request) {
        return $query->wordSearch($request->get("search"))->familySearch($request->get("family"))->dateSearch($request->get("date_add"))->contractSearch($request->get("contrato"))->workDaySearch($request->get("work_day"))->SalarySearch($request->get("salario"));
    }

    /**
     * No activas
     * Busca las ofertas que no han sido validadas
     * @param $query
     */

    public function scopeNoActive($query)
    {
        $query->where('status', '=', "Pend_Validacion");
    }

    /**
     * Por confirmar
     * Busca por las ofertas estan pendientes de validación
     * @param $query
     */

    public function scopePorConfirmar($query)
    {
        $query->where('status', '=', "Pend_Confirmacion");
    }


}
