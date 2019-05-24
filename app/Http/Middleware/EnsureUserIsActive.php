<?php

namespace App\Http\Middleware;

use App\Models\Interfaces\MustBeActivated;
use Illuminate\Support\Facades\Redirect;
use Closure;

class EnsureUserIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $redirectToRoute
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $redirectToRoute = null)
    {

        if (! $request->user() ||
            ($request->user() instanceof MustBeActivated &&
                ! $request->user()->hasActivatedAccount())) {
            return $request->expectsJson()
                ? abort(403, 'Your account has not been activated.')
                : Redirect::route($redirectToRoute ?: 'password.prompt');
        }

        return $next($request);
    }
}
