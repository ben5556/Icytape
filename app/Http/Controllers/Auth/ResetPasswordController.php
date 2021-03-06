<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    public function showResetForm(Request $request, $token = null)
    {
        return view('theme::auth.reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    protected function sendResetResponse($response)
    {
        return redirect($this->redirectPath())
                            ->with(array('note' => trans('lang.password_reset'), 'note_type' => 'success'));
    }

    protected function sendResetLinkResponse($response)
    {
        return back()->with(array('note' => trans('lang.password_reset'), 'note_type' => 'success'));
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
