<?php

namespace App\Models\Traits;



trait HasAuthor
{

    /**
     * @param $user
     */
    public function assignAuthor($user): void
    {
        $this->user_id = $user->id;
    }

    /**
     * @param $user
     */
    public function setAuthor($user): void
    {
        $this->author()->save($user);
    }

    /**
     * @param $user
     * @return bool
     */
    public function isAuthoredBy($user): bool
    {
        return $user && $this->user_id === $user->id;
    }

    /**
     * Scope a query to only articles of certain user
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param $user
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAuthoredBy($query, $user)
    {
        $userId = is_int($user) ? $user : $user->id;
        return $query->where('user_id', $userId);
    }
}