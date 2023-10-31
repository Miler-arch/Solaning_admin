<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Course;
use App\Models\DetailRegister;
use App\Models\Registration;
use Luecano\NumeroALetras\NumeroALetras;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        $courses = Course::where('status', '1')->get();
        return view('registrations.index', compact('clients', 'courses'));
    }
    public function create()
    {
        return view('registrations.index');
    }

    public function store(Request $request)
    {
        // Obtener el próximo ID de registro
        $nextId = DetailRegister::max('id') + 1;
        // Formatear el ID con ceros al inicio
        $formattedId = str_pad($nextId, 5, '0', STR_PAD_LEFT);

        $registrationData['id'] = $formattedId;
        $registrationData['client_id'] = $request->input('client_id');
        $registrationData['course_id'] = $request->input('course_id');
        $registrationData['mount'] = $request->input('mount');
        $registrationData['discount'] = $request->input('discount');
        $registrationData['discounted_price'] = $request->input('discounted_price');
        $registrationData['type_payment'] = $request->input('type_payment');
        $registrationData['business_name'] = $request->input('business_name');
        $registrationData['nit'] = $request->input('nit');

        $estadoPago = '0';

        // Asignar el ID formateado al registro
        $registrationData['method_payment'] = $estadoPago;
        $coursePrice = Course::find($registrationData['course_id'])->price;

        if ($registrationData['mount'] < $coursePrice && $registrationData['mount'] < $registrationData['discounted_price']) {
            $estadoPago = '0';
        } elseif ($registrationData['mount'] == $coursePrice || $registrationData['mount'] == $registrationData['discounted_price']) {
            $estadoPago = '1';
        }

        // if ($registrationData['mount'] > $registrationData['discounted_price']){
        //         toastr()->error('El monto ingresado es mayor al precio del curso o al precio con descuento');
        //         return redirect()->route('registrations.index');
        // }

        if ($registrationData['mount'] > $coursePrice) {
                toastr()->error('El monto ingresado es mayor al precio del curso');
                return redirect()->route('registrations.index');
        }else{

        // Convertir el monto a letras
        $numberToWords = new NumeroALetras();
        $montoDecimal = $registrationData['mount'];
        $montoEnPalabras = $numberToWords->toWords($montoDecimal);
        $montoEnPalabrasString = $montoEnPalabras;
        // Discount
        $discountRegistration = $coursePrice - ($coursePrice * ($registrationData['discount'] / 100));
        // Crear el registro con el ID formateado
        $data = auth()->user()->detailRegisters()->create($registrationData);
        // Generar y devolver el PDF
        $pdf = \PDF::loadView('registrations.recibe', [
            'data' => $data,
            'montoEnPalabrasString' => $montoEnPalabrasString,
            'discountRegistration' => $discountRegistration,
            'formattedId' => $formattedId,
        ]);
        return $pdf->stream('recibe.pdf');
        }
    }

}
