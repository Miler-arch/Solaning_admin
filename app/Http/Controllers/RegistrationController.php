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
        $course = Course::find($request->input('course_id'));
        $coursePrice = $course->price;

        $discountedPrice = $coursePrice - ($coursePrice * ($request->input('discount') / 100));

        if ($request->input('mount') > $discountedPrice) {
            flash()->addError('El monto ingresado es mayor al precio del curso.');
            return redirect()->route('registrations.index');
        }

        $estadoPago = ($request->input('mount') < $discountedPrice) ? '0' : '1';

        $numberToWords = new NumeroALetras();
        $montoDecimal = $request->input('mount');
        if ($montoDecimal >= 1000) {
            $montoEnPalabras = "UN MIL";
            $centavos = $montoDecimal - 1000;
            if ($centavos > 0) {
                $montoEnPalabras .= " " . $numberToWords->toWords($centavos);
            }
        } else {
            $montoEnPalabras = $numberToWords->toWords($montoDecimal);
        }
        $montoEnPalabrasString = $montoEnPalabras;

        $discountRegistration = $coursePrice - $discountedPrice;

        $formattedId = str_pad(DetailRegister::max('id') + 1, 5, '0', STR_PAD_LEFT);
        $registrationData = [
            'id' => $formattedId,
            'client_id' => $request->input('client_id'),
            'course_id' => $request->input('course_id'),
            'mount' => $request->input('mount'),
            'discount' => $request->input('discount'),
            'discounted_price' => $discountedPrice,
            'type_payment' => $request->input('type_payment'),
            'business_name' => $request->input('business_name'),
            'nit' => $request->input('nit'),
            'method_payment' => $estadoPago,
        ];

        $data = auth()->user()->detailRegisters()->create($registrationData);

        $pdf = \PDF::loadView('registrations.recibe', [
            'data' => $data,
            'montoEnPalabrasString' => $montoEnPalabrasString,
            'discountRegistration' => $discountRegistration,
            'formattedId' => $formattedId,
        ]);
        return $pdf->stream('recibe.pdf');
    }


    public function update(Request $request, $id)
    {
        $registro = DetailRegister::findOrFail($id);

        $accumulatedMount = $registro->mount;
        foreach ($registro->registrationes as $payment) {
            $accumulatedMount += $payment->mount_update;
        }

        Registration::create([
            'mount_update' => $request->input('updated_amount'),
            'date_update' => now(),
            'detail_register_id' => $registro->id,
            'client_id' => $registro->client_id,
        ]);


        $registro->mount = $accumulatedMount;
        $registro->save();

        return redirect()->back()->with('success', 'Información de pago actualizada correctamente.');
    }


}
