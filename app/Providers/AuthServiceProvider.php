<?php

namespace App\Providers;

use App\Cicle;
use App\Enterprise;
use App\Family;
use App\Http\Controllers\EnterpriseController;
use App\Offer;
use App\Policies\CiclePolicy;
use App\Policies\EnterprisePolicy;
use App\Policies\FamilyPolicy;
use App\Policies\OfferPolicy;
use App\Policies\StudentPolicy;
use App\Policies\TeacherPolicy;
use App\Policies\UserPolicy;
use App\Student;
use App\Teacher;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Cicle::class => CiclePolicy::class,
        Offer::class => OfferPolicy::class,
        Student::class => StudentPolicy::class,
        Enterprise::class => EnterprisePolicy::class,
        Family::class => FamilyPolicy::class,
        Teacher::class => TeacherPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
