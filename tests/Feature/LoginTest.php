<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{

    use DatabaseTransactions;


    public function test_auth_without_activation()
    {
        //HAVING
        $user = User::Active(0)->inRandomOrder()->first();

        //WHEN
        $this->visit(route("login"))
            ->type($user->email,"email")
            ->type("123456","password")
            ->press("Acceder");

        //THEN
        $this->seePageIs(route("login"))
        ->see("Estas credenciales no coinciden con nuestros registros");
    }


    public function test_auth_with_activation()
    {

        //HAVING
        $user = User::Active(1)->inRandomOrder()->first();

        //WHEN
        $this->visit(route("login"))
            ->type($user->email,"email")
            ->type("123456","password")
            ->press("Acceder");

        //THEN
        if ($user->rol != "is_student"){
            $this->seePageIs(route("home"));
        }else{
            $this->seePageIs(route("offers.index"));
        }
    }

}
