<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Course;
use App\Models\Registration;
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
        $user = auth()->user();
        $registrationData = $request->all();
        $coursePrice = $user->registrations()->first()->course->price;

        if ($registrationData['mount'] > $coursePrice) {
            return redirect()->route('registrations.index')->with('error', 'El monto ingresado es mayor al precio del curso');
        } else {
            $data = $user->registrations()->create($registrationData);
            $pdf = \PDF::loadView('registrations.recibe', compact('request', 'data'));
            return $pdf->stream('recibe.pdf');
        }
    }


    public function show(string $id)
    {

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
