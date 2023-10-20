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

        $coursePrice = Course::find($registrationData['course_id'])->price;

        if ($registrationData['mount'] > $coursePrice) {
                return redirect()->route('registrations.index')->with('error', 'El monto ingresado es mayor al precio del curso');
        }else{
                 // Obtener el próximo ID de registro
        $nextId = Registration::max('id') + 1;

        // Formatear el ID con ceros al inicio
        $formattedId = str_pad($nextId, 5, '0', STR_PAD_LEFT);

        // Asignar el ID formateado al registro
        $registrationData['id'] = $formattedId;
        $registrationData['start_date'] = date('j-M-Y');

        // Discount
        $discountRegistration = $coursePrice - ($coursePrice * ($registrationData['discount'] / 100));
        // Crear el registro con el ID formateado
        $data = $user->registrations()->create($registrationData);

        // Generar y devolver el PDF
        $pdf = \PDF::loadView('registrations.recibe', compact('request', 'data', 'formattedId', 'discountRegistration'));
        return $pdf->stream('recibe.pdf');
        }
    }
}
