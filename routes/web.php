<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name("index");

Route::get("register/teacher",["as" => "register.teacher" , "uses" => 'Auth\RegisterController@teacher']);

Route::get("register/enterprise",["as" => "register.enterprise" , "uses" => 'Auth\RegisterController@enterprise']);

Route::get("register/student",["as" => "register.student" , "uses" => 'Auth\RegisterController@student']);

Auth::routes();

Route::get('/home', ["as" => "home" , "uses" => 'HomeController@index',"middleware" => "auth" ]);


// RUTAS FUERA DE ADMIN

    //**ALUMNO**
Route::post("student/store",["as" => "student.store", "uses" => "StudentController@store"]);

    // **PROFESOR**
Route::post("teachers/store",["as" => "teacher.store", "uses" => "TeacherController@store"]);


    // **EMPRESA**
Route::post("enterprise/store",["as" => "enterprise.store", "uses" => "EnterpriseController@store"]);

    //  **USER**
Route::get("account/myoffers",["as"=>"user.myoffers","uses"=> "UserController@myoffers"])->middleware("auth");
Route::get("user/{user}",["as"=>"user.profile","uses"=> "UserController@profile"]);
Route::get("account/settings",["as"=>"user.settings","uses"=> "UserController@settings"])->middleware("auth");


    // **OFFER**
Route::get("offer/create",["as" => "offers.create", "uses" => "OfferController@create"])->middleware("rol:is_admin|is_enterprise");
Route::get("offers",["as" => "offers.index", "uses" => "OfferController@index"])->middleware("auth");
Route::get("offer/{offer}",["as" => "offers.show", "uses" => "OfferController@show"])->middleware("auth");
Route::get("offer/{offer}/edit",["as" => "offers.edit", "uses" => "OfferController@edit"])->middleware("rol:is_admin|is_enterprise");
Route::post("offer/store",["as" => "offers.store", "uses" => "OfferController@store"])->middleware("rol:is_admin|is_enterprise");
Route::put("offer/{offer}",["as" => "offers.update", "uses" => "OfferController@update"])->middleware("rol:is_admin|is_enterprise");
Route::delete("offer/{offer}",["as" => "offers.destroy", "uses" => "OfferController@destroy"])->middleware("rol:is_admin|is_enterprise");
Route::get("offer/{offer}/subscribe",["as" => "offers.subscribe", "uses" => "OfferController@subscribe"])->middleware("rol:is_student");
Route::get("offer/{offer}/unsubscribe",["as" => "offers.unsubscribe", "uses" => "OfferController@unsubscribe"])->middleware("rol:is_student");
Route::get("offer/{selection}/proffer",["as" => "offers.proffer", "uses" => "OfferController@proffer"])->middleware("rol:is_student");
Route::post("offer/{selection}/answer",["as" => "offers.answer", "uses" => "OfferController@answer"])->middleware("rol:is_student");

Route::group(["prefix" => "admin"], function () {

    Route::get("teacher/inactive",["as"=>"teacher.inactive","uses"=> "TeacherController@inactive"])->middleware("rol:is_admin");
    Route::get("enterprise/inactive",["as"=>"enterprise.inactive","uses"=> "EnterpriseController@inactive"])->middleware("rol:is_admin|is_teacher");
    Route::get("student/inactive",["as"=>"student.inactive","uses"=> "StudentController@inactive"])->middleware("rol:is_admin|is_teacher");
    Route::get("offers/inactive",["as"=>"offers.inactive","uses"=> "OfferController@inactive"]);

    Route::get("offer/{offer}/activate",["as" => "offers.activate", "uses" => "OfferController@activate"])->middleware("rol:is_admin|is_teacher");
    Route::post("offer/{offer}/assign",["as" => "offers.assign", "uses" => "OfferController@assign"])->middleware("rol:is_admin|is_teacher");

    Route::get("family/cicles/{family}",["as" => "family.getCiclesById", "uses" => "FamilyController@getCiclesByFamilyId"]);

    Route::delete("offer/{selected}/selected",["as" => "offers.selected.destroy", "uses" => "OfferController@selectedDelete"])->middleware("rol:is_admin|is_teacher");

    //Route::resource('offers','OfferController');
    Route::put("user/toggle/active/{user}",["as"=>"user.toggle.active","uses"=> "UserController@changeActive"]);
    Route::post("user/toggle/active/selected",["as"=>"user.toggle.selected","uses"=> "UserController@changeSelected"]);
    Route::get("user/inactive",["as"=>"user.inactive","uses"=> "UserController@inactive"])->middleware("rol:is_admin|is_teacher");

    //Route::resource('enterprise', 'EnterpriseController');

    Route::put("enterprise/{enterprise}",["as" => "enterprise.update", "uses" => "EnterpriseController@update"])->middleware("rol:is_admin|is_teacher|is_enterprise");
    Route::get("enterprise/create",["as" => "enterprise.create", "uses" => "EnterpriseController@create"])->middleware("rol:is_admin|is_teacher");
    Route::get("enterprise",["as" => "enterprise.index", "uses" => "EnterpriseController@index"])->middleware("rol:is_admin|is_teacher");
    Route::get("enterprise/{enterprise}",["as" => "enterprise.show", "uses" => "EnterpriseController@show"])->middleware("rol:is_teacher","OneSelf");
    Route::get("enterprise/{enterprise}/edit",["as" => "enterprise.edit", "uses" => "EnterpriseController@edit"])->middleware("rol:is_admin|is_teacher|is_enterprise");
    Route::delete("enterprise/{enterprise}",["as" => "enterprise.destroy", "uses" => "EnterpriseController@destroy"])->middleware("rol:is_admin|is_enterprise");



//    Route::resource('student', 'StudentController');

    Route::get("student/create",["as" => "student.create", "uses" => "StudentController@create"])->middleware("rol:is_admin|is_teacher");
    Route::get("student",["as" => "student.index", "uses" => "StudentController@index"])->middleware("rol:is_admin|is_teacher");
    Route::get("student/{student}",["as" => "student.show", "uses" => "StudentController@show"])->middleware("rol:is_admin|is_teacher");
    Route::get("student/{student}/edit",["as" => "student.edit", "uses" => "StudentController@edit"]);
    Route::delete("student/{student}",["as" => "student.destroy", "uses" => "StudentController@destroy"])->middleware("rol:is_admin|is_teacher|is_student");
    Route::put("student/{student}",["as" => "student.update", "uses" => "StudentController@update"])->middleware("rol:is_admin|is_teacher|is_student");
    Route::get("student",["as" => "student.index", "uses" => "StudentController@index"])->middleware("rol:is_admin|is_teacher");
    Route::post("student/{student}/cicle/add",["as" => "student.cicle.add", "uses" => "StudentController@newCicle"])->middleware("rol:is_admin|is_student");
    Route::delete("student/{student}/cicle/{cicle}",["as" => "student.cicle.destroy", "uses" => "StudentController@delCicle"])->middleware("rol:is_admin|is_student");
//    Route::resource('teacher', 'TeacherController');


    Route::get("teacher/create",["as" => "teacher.create", "uses" => "TeacherController@create"])->middleware("rol:is_admin");
    Route::get("teacher",["as" => "teacher.index", "uses" => "TeacherController@index"])->middleware("rol:is_admin");
    Route::get("teacher/{teacher}",["as" => "teacher.show", "uses" => "TeacherController@show"])->middleware("rol:is_admin|is_teacher");
    Route::get("teacher/{teacher}/edit",["as" => "teacher.edit", "uses" => "TeacherController@edit"])->middleware("rol:is_admin|is_teacher");
    Route::delete("teacher/{teacher}",["as" => "teacher.destroy", "uses" => "TeacherController@destroy"])->middleware("rol:is_admin|is_teacher");
    Route::put("teacher/{teacher}",["as" => "teacher.update", "uses" => "TeacherController@update"]);
    Route::post("teacher/{teacher}/cicle/add",["as" => "teacher.cicle.add", "uses" => "TeacherController@newCicle"])->middleware("rol:is_admin|is_teacher");
    Route::delete("teacher/{teacher}/cicle/{cicle}",["as" => "teacher.cicle.destroy", "uses" => "TeacherController@delCicle"])->middleware("rol:is_admin|is_teacher");

    Route::get("invitations",["as"=>"teacher.invitations","uses"=> "TeacherController@invitations"])->middleware("rol:is_admin");
    Route::delete("invitation/{invitation}/cancel",["as"=>"teacher.invitation.cancel","uses"=> "TeacherController@cancelInvitation"])->middleware("rol:is_admin");
    Route::post("teacher/invitations/clean",["as"=>"teacher.invitations.clean","uses"=> "TeacherController@cleanInvitations"])->middleware("rol:is_admin");
    Route::post("teacher/invite",["as"=>"teacher.invite","uses"=> "TeacherController@invite"])->middleware("rol:is_admin");


    Route::group(['middleware' => 'rol:is_admin'], function() { // ** Alguna otra forma de añadirle un middleware a un resource?? Refactorización si es mejorable **/
        Route::resource('family', 'FamilyController');
        Route::resource("cicle", 'CicleController');
    });
});
