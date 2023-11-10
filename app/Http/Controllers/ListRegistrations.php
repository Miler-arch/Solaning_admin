<?php

namespace App\Http\Controllers;

use App\Models\DetailRegister;
use Luecano\NumeroALetras\NumeroALetras;

class ListRegistrations extends Controller
{
    public function index()
    {
        $registrationsList = DetailRegister::orderBy('id', 'desc')->with('user', 'client', 'course')->get();
        return view('registrations.list_registrations', compact('registrationsList'));
    }

    public function pdf(string $id)
    {
        $data = DetailRegister::findOrfail($id);
        $formattedId = str_pad($data->id, 5, '0', STR_PAD_LEFT);
        $data->id = $formattedId;
        $numberToWords = new NumeroALetras();
        $montoDecimal = $data->mount;
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
        $coursePrice = $data->course->price;
        $discountRegistration = $coursePrice - ($coursePrice * ($data->discount / 100));

        $pdf = \PDF::loadView('registrations.recibe', [
            'data' => $data,
            'formattedId' => $formattedId,
            'montoEnPalabrasString' => $montoEnPalabrasString,
            'discountRegistration' => $discountRegistration

        ]);
        return $pdf->stream('recibe.pdf');
    }
}
