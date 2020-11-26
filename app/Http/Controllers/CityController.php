<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $cities = City::orderBy('name')->paginate(10);

        return view('cities.index')->with('cities', $cities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('cities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'name' => 'required',
        ]);


        if ($validateData->fails()) {
            return redirect('cities/create')->withErrors($validateData)->withInput();
        } else {
            $city = new City();
            $city->name = $request->name;
            $city->save();
            return redirect('cities/create')->with('message', 'Ciudad creada exitosamente');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $city = City::findOrFail($id);

        return view('cities.show', compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $city = City::find($id);

        return view('cities.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $validateData = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validateData->fails()) {
            return back()->withErrors($validateData)->withInput();
        } else {
            $city = City::find($id);
            $city->name = $request->name;
            $city->save();
            return back()->with('message', 'Ciudad actualizada correctamente')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $city = City::find($id);
        $city->delete();
        return redirect('/cities');
    }
}
