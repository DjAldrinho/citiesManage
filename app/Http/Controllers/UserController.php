<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{


    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::orderBy('name')->paginate(10);

        return view('users.index')->with('users', $users);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
        ]);


        if ($validateData->fails()) {
            return redirect('users/create')->withErrors($validateData)->withInput();
        } else {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $this->generatePassword();
            $user->save();
            return redirect('users/create')->with('message', 'Usuario creado exitosamente');
        }
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('users.edit', compact('user'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }


    public function update(Request $request, $id)
    {
        $validateData = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
        ]);

        if ($validateData->fails()) {
            return back()->withErrors($validateData)->withInput();
        } else {

            $user = User::findOrFail($id);

            $userWithOutEvents = User::withoutEvents(function () use ($user, $request) {
                $user->name = $request->name;
                $user->email = $request->email;
                $user->save();
                return $user;
            });

            return back()->with('message', 'Usuario actualizado correctamente')->withInput();
        }

    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/users');
    }

    private function generatePassword()
    {
        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');

        return substr($random, 0, 10);
    }
}
