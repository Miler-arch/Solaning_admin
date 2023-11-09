<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteStoreRequest;
use App\Http\Requests\ClienteUpdateRequest;
use App\Models\Client;

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
            'birthdate' => $request->birthdate,
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

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.edit', compact('client'));
    }

    public function update(ClienteUpdateRequest $request, $id)
    {
        $client = Client::findOrFail($id);
        $client->update([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'birthdate' => $request->birthdate,
            'age' => $request->age,
            'ci' => $request->ci,
            'email' => $request->email,
            'phone' => $request->phone,
            'reference_phone' => $request->reference_phone,
            'mount_select' => $request->mount_select,
            'nit' => $request->nit,
            'business_name' => $request->business_name,
        ]);
        flash()->addSuccess('Alumno actualizado exitosamente', 'Muy Bien!');
        return redirect()->route('clients.index', compact('client'));
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        if ($client->detailRegisters->count() > 0) {
            flash()->addWarning('No se puede eliminar el alumno porque tiene registros asociados', 'Atención!');
            return redirect()->route('clients.index');
        }
        $client->delete();
        flash()->addSuccess('Alumno eliminado exitosamente', 'Muy Bien!');
        return redirect()->route('clients.index');
    }

}
