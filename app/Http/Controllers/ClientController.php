<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteStoreRequest;
use App\Http\Requests\ClienteUpdateRequest;
use App\Models\Client;
use App\Models\Course;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::orderBy('id', 'desc')->get();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(ClienteStoreRequest $request)
    {
        Client::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'age' => $request->age,
            'ci' => $request->ci,
            'email' => $request->email,
            'phone' => $request->phone,
            'reference_phone' => $request->reference_phone,
            'mount_select' => $request->mount_select,
            'nit' => $request->nit,
            'business_name' => $request->business_name,
        ]);
        return response()->json(['success' => 'Alumno creado exitosamente.']);
    }

    public function show()
    {
        return view('clients.show');
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.edit', compact('client'));
    }

    public function update(ClienteUpdateRequest $request, $id)
    {
        $client = Client::findOrFail($id);
        $client->update($request->all());
        toastr()->success('Alumno actualizado exitosamente!');
        return redirect()->route('clients.index', compact('client'));
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        if ($client->registrations->count() > 0) {
            toastr()->error('No se puede eliminar el alumno porque tiene registros asignados!');
            return redirect()->route('clients.index');
        }
        $client->delete();
        toastr()->success('Alumno eliminado exitosamente!');
        return redirect()->route('clients.index');
    }

}
