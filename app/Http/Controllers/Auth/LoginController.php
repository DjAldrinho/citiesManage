<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showPasswordForm(Request $request)
    {
        $token = explode('|', base64_decode($request->token));
        $email = $token[0];
        $password = $token[1];

        if ($token) {
            $user = User::where([
                'email' => $email,
                'password' => $password
            ])->firstOrFail();

            if ($user) {
                return view('auth.passwords.change')->with('id', $user->id);
            }

        }

        abort(403, 'Unauthorized.');
    }

    public function changePassword(Request $request)
    {

        $validateData = Validator::make($request->all(), [
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);


        if ($validateData->fails()) {
            return back()->withErrors($validateData);
        } else {

            $user = User::findOrFail($request->id);

            $userWithOutEvents = User::withoutEvents(function () use ($user, $request) {
                $user->password = Hash::make($request->password);
                $user->save();
                return $user;
            });

            return redirect('login')->with('message', __('auth.successful_change_password'));
        }
    }
}
