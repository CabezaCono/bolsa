<?php

/**
 * Modelo de Ciclos
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Class Cicle
 *
 * Incluye las relaciones de los ciclos y filtros de búsqueda
 *
 * @package App
 */

class Cicle extends Model
{

    /**
     * Filliable
     *
     * Datos que Eloquent puede tratar sobre un objeto ciclo
     * @var array
     */
    protected $fillable = [
        'name', "plan", "tipo", "family_id", "created_at"
    ];

    /** RELACIONES **/

    /**
     * Relacion con familia
     *
     * Un ciclo pertenece a una familia
     * @return mixed
     */
    public function family()
    {
        return $this->belongsTo('App\Family');
    }

    //Relacion con teachers
    /**
     * Relación con profesores
     *
     * Un ciclo puede tener varios profesores
     * @return mixed
     */
    public function teachers()
    {
        return $this->belongsToMany('App\Teacher', 'cicle_teachers', 'cicle_id', 'teacher_id')->withTimestamps();
    }

    //Relacion con student

    /**
     * Relación con alumnos
     *
     * un ciclo puede pertenecer a varios alumnos
     * @return mixed
     */
    public function students()
    {
        return $this->belongsToMany('App\Student', 'student_courses', 'cicle_id', 'student_id');
    }






    /** SCOPES **/

    /**
     * Busqueda por nombre
     * @param $query hace referencia a la consulta, la cual se modifica con los datos siguientes
     * @param Request $request datos que introduce el usuario para activar la sentenencia de query.
     */
    public function scopeName($query, Request $request)
    {
        $name = $request->get("name");
        if (trim($name) != '') {
            $query->where('name', 'LIKE', "%$name%");
        }
    }

}
