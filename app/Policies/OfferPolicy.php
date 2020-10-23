<?php

namespace App\Policies;

use App\User;
use App\Offer;
use Illuminate\Auth\Access\HandlesAuthorization;

class OfferPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the offer.
     *
     * @param  \App\Enterprise $enterprise
     * @param  \App\Offer  $offer
     * @return mixed
     */
    public function view(User $user, Offer $offer)
    {
        if ($user->isAdmin()) {
            return true;
        } elseif ($user->isTeacher()) {
            return true;
        }elseif ($user->isStudent()) {
            return true;
        } elseif ($user->isEnterprise() && $user->enterprise->id == $offer->enterprise_id) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can create offers.
     *
     * @param  \App\Enterprise $enterprise
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        } elseif ($user->isEnterprise()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can update the offer.
     *
     * @param  \App\Enterprise $enterprise
     * @param  \App\Offer  $offer
     * @return mixed
     */
    public function update(User $user, Offer $offer)
    {

        if ($user->isAdmin()) {
            return true;
        } elseif ($user->isEnterprise() && $user->enterprise->id == $offer->enterprise_id) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the offer.
     *
     * @param  \App\Enterprise $enterprise
     * @param  \App\Offer  $offer
     * @return mixed
     */
    public function delete(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        } else {
            return false;
        }
    }
}
