<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Events\Activated;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Access\AuthorizationException;

class ActivationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Activation Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for setting the user password
    | and activating their account after the email has been verified.
    |
    */

    use RedirectsUsers;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }


    protected function redirectTo()
    {
        return '/users/'.Auth::user()->id.'/articles';
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Show the password prompt form.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('auth.passwords.activate');
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function activate(Request $request)
    {
        if ($request->user()->hasActivatedAccount()) {
            return redirect($this->redirectPath());
        }
        $data = $request->all();
        $this->validator($data)->validate();
        $password = Hash::make($data['password']);

        if ($request->user()->activateAccount($password)) {
            event(new Activated($request->user()));
        }

        return redirect($this->redirectPath())->with('activated', true);
    }

}
