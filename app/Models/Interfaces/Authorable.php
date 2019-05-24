<?php

namespace App\Models\Interfaces;


interface Authorable
{
    public function assignAuthor($user): void;
    public function setAuthor($user): void;
    public function isAuthoredBy($user): bool;
}