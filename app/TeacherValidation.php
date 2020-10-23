<?php
/**
 * Clase de validacion de profesores
 *
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TeacherValidation
 * Gestiona la informacion relativa a las activaciones de profesores
 * @package App
 */
class TeacherValidation extends Model
{

    /**
     * Filliable
     *
     *  Datos que Eloquent puede tratar sobre el objeto
     * @var array
     */
    protected $fillable =[
        'id',"teacher_id","user_id", "action", "created_at","updated_at"
    ];

    /** RELACIONES **/

    /**
     * Teacher
     * Una validacion pertenece a un profesor
     * @return mixed
     */
    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }

    /**
     * Usuario
     * Una validacion pertenece a un usuario
     * @return mixed
     */

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Rol Attr
     *
     * Devuelve el tipo de ROL del profesor
     * @return string
     */
    public function getRolAttribute()
    {
        switch ($this->user->rol){
            case "is_student":
                return "Alumno";
                break;
            case "is_teacher":
                return "Profesor";
                break;
            case "is_admin":
                return "Administrador";
                break;
            case "is_enterprise":
                return "Empresa";
                break;

        }
    }





    /** GETTERS **/ //Aquí los getters






    /** SETTERS **/ //Aquí los setters






    /** SCOPES **/ //Aquí los scopes

    public function scopeAction($query,$action)
    {
        if(trim($action) != '') {
            $query->where('action', '=', $action);
        }

    }

}
