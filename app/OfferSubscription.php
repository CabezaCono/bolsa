<?php
/**
 * Modelo oferta
 *
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OfferSubscription
 * Gestiona la suscripciones a ofertas
 * @package App
 */

class OfferSubscription extends Model
{
    /**
     * Filliable
     *
     *  Datos que Eloquent puede tratar sobre el objeto
     * @var array
     */
    protected $fillable =[
        'offer_id',"student_id"
    ];

    /** RELACIONES **/

    /**
     * Offer
     *
     * Una suscripcion de oferta pertenece a una ofertas
     * @return mixed
     */
    public function offer()
    {
        return $this->belongsTo('App\Offer');
    }

    /**
     * Una suscripción de oferta pertenece a un estudiante
     * @return mixed
     */
    public function student()
    {
        return $this->belongsTo('App\Student');
    }






}
