<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Course;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        $courses = Course::all();
        return view('registrations.index', compact('clients', 'courses'));
    }
    public function create()
    {
        return view('registrations.index');
    }
    public function store(Request $request)
    {
        auth()->user()->registrations()->create([
            'method_payment' => $request->method_payment,
            'business_name' => $request->business_name,
            'concept' => $request->concept,
            'nit' => $request->nit,
            'mount' => $request->mount,
            'start_date' => $request->start_date,
            'client_id' => $request->client_id,
            'course_id' => $request->course_id,
        ]);
        return redirect()->route('registrations.index');
    }
    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
