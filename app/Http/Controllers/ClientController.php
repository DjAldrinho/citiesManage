<?php

namespace App\Http\Controllers;

use App\City;
use App\Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {

        $filter = $request->query('city');

        if (!empty($filter)) {

            $clients = Client::whereHas('city', function ($query) use ($filter) {
                $query->where('cities.name', 'like', '%' . $filter . '%');
            })->orderBy('name')
                ->paginate(10);

        } else {
            $clients = Client::orderBy('name')->paginate(10);
        }

        return view('clients.index')->with('clients', $clients)->with('filter', $filter);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $cities = City::orderBy('name')->get();

        return view('clients.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'name' => 'required',
            'city' => 'required',
            'code' => 'required',
        ]);


        if ($validateData->fails()) {
            return redirect('clients/create')->withErrors($validateData)->withInput();
        } else {

            $client = new Client();
            $client->name = $request->name;
            $client->city_id = $request->city;
            $client->code = $request->code;
            $client->save();

            return redirect('clients/create')->with('message', 'Cliente creado exitosamente');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::findOrFail($id);


        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);

        $cities = City::orderBy('name')->get();

        return view('clients.edit', compact('client', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = Validator::make($request->all(), [
            'name' => 'required',
            'city' => 'required',
            'code' => 'required',
        ]);


        if ($validateData->fails()) {
            return back()->withErrors($validateData)->withInput();
        } else {
            $client = Client::find($id);
            $client->name = $request->name;
            $client->city_id = $request->city;
            $client->code = $request->code;
            $client->save();

            return back()->with('message', 'Cliente actualizado correctamente')->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();
        return redirect('/clients');
    }
}
