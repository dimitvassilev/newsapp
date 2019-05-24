<?php
namespace App\Models\Interfaces;


interface MustBeActivated
{
    /**
     * Determine if the user has activated their account.
     *
     * @return bool
     */
    public function hasActivatedAccount();

    /**
     * Mark the given user's account as active.
     *
     * @param string $password
     * @return bool
     */
    public function activateAccount($password);

}