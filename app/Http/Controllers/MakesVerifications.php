<?php

namespace App\Http\Controllers;


use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

trait MakesVerifications
{

    /**
     * Check if the article exists
     * @param \Illuminate\Http\Request
     * @param $id
     */
    protected function verifyExistence($request)
    {
        $articleId = $request->route('id');
        if(!$this->repository->has($articleId))
        {
            abort(404);
        }
    }

    /**
     * Check if article is authored by the current user
     * @param \Illuminate\Http\Request
     * @throws AuthorizationException
     */
    protected function verifyOwnership(Request $request)
    {
        $articleId = $request->route('id');
        if (!$this->repository->isAuthoredBy($articleId, $request->user()))
        {
            throw new AuthorizationException();
        }
    }
}