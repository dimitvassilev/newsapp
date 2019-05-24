<?php

namespace App\Models\Traits;

trait MustBeActivated
{

    /**
     * Determine if the user has activated their account.
     *
     * @return bool
     */
    public function hasActivatedAccount()
    {
        return $this->active;
    }

    /**
     * Mark the given user's account as active.
     *
     * @return bool
     */
    public function activateAccount($password)
    {
        $this->password = $password;
        $this->active = true;
        $this->save();
        return true;
    }
}