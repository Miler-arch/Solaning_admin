<?php

namespace App\Http\Controllers;

use App\Exports\RegistrationsExport;
use App\Models\Client;
use App\Models\Course;
use App\Models\DetailRegister;
use App\Models\Registration;
use Luecano\NumeroALetras\NumeroALetras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class RegistrationController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        $courses = Course::where('status', '1')->get();
        return view('registrations.index', compact('clients', 'courses'));
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
        $montoInicial = $request->input('mount');
        $tipoDePago = $request->input('type_payment');
        $saveMountInWords = $montoEnPalabrasString;
        $registrationData = [
            'id' => $formattedId,
            'client_id' => $request->input('client_id'),
            'course_id' => $request->input('course_id'),
            'mount_initial' => $montoInicial,
            'mount' => $request->input('mount'),
            'discount' => $request->input('discount'),
            'discounted_price' => $discountedPrice,
            'type_payment_initial' => $tipoDePago,
            'type_payment' => $request->input('type_payment'),
            'business_name' => $request->input('business_name'),
            'nit' => $request->input('nit'),
            'method_payment' => $estadoPago,
            'save_mount_in_words' => $saveMountInWords,
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

    public function update(Request $request, $id){
        $registro = DetailRegister::findOrFail($id);

        $maxPartialPayments = 3;
        $currentPartialPayments = Registration::where('detail_register_id', $registro->id)->count();

        if ($currentPartialPayments >= $maxPartialPayments) {
            return redirect()->back()->with('error', 'Se ha alcanzado el límite de 3 pagos parciales para este registro.');
        }

        $montoInicial = $registro->mount_initial;
        $dateStart = $registro->created_at;

        $tipoDePago = $registro->type_payment_initial;
        $montoActualizado = $request->input('updated_amount');
        $typePayment = $request->input('updated_type_payment');
        $montoAcumulado = $registro->mount + $montoActualizado;

        if ($montoAcumulado > $registro->discounted_price) {
            return redirect()->back()->with('error', 'El monto ingresado es mayor al precio del curso.');
        }

        $registro->mount = $montoAcumulado;
        $registro->type_payment = $typePayment;
        $registro->save();

        if ($montoAcumulado >= $registro->discounted_price) {
            $registro->update(['method_payment' => 1]);
        }

        $numberToWords = new NumeroALetras();
        $montoDecimal = $montoActualizado;
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

        $formattedId = str_pad(DetailRegister::max('id') + 1, 5, '0', STR_PAD_LEFT);

        $pdf = \PDF::loadView('registrations.recibe_partial', [
            'data' => $registro,
            'formattedId' => $formattedId,
            'montoEnPalabrasString' => $montoEnPalabrasString,
            'montoActualizado' => $montoActualizado,
            'typePayment' => $typePayment,
        ]);

        $nombreArchivo = 'pago_parcial_' . $registro->id . '_' . now()->format('d-m-Y-H-i-s') . '.pdf';

        $rutaArchivo = 'public/pdfs/' . $registro->id . '/' . $nombreArchivo;

        $pdfFile = new Registration();
        $pdfFile->file_path = $nombreArchivo;
        $pdfFile->detail_register_id = $registro->id;
        $pdfFile->client_id = $registro->client_id;
        $pdfFile->mount_update = $montoActualizado;
        $pdfFile->date_update = now();
        $pdfFile->mount_inicial = $montoInicial;
        $pdfFile->date_start = $dateStart;
        $pdfFile->updated_type_payment = $typePayment;
        $pdfFile->type_payment_inicial = $tipoDePago;

        $pdfFile->save();

        Storage::put($rutaArchivo, $pdf->output());

        flash()->addSuccess('Pago registrado exitosamente', 'Muy Bien!');
        return redirect()->back()->with('pdf_path', $rutaArchivo);
    }


    public function mostrarPDF($detailRegisterId, $nombreArchivo)
    {
        if ($nombreArchivo === null) {
            abort(404);
        }
        $rutaArchivo = 'public/pdfs/' . $detailRegisterId . '/' . $nombreArchivo;
        if (Storage::exists($rutaArchivo)) {
            $contenido = Storage::get($rutaArchivo);
            return response($contenido, 200)->header('Content-Type', 'application/pdf');
        } else {
            abort(404);
        }
    }

    public function Report()
    {
        $reports = DetailRegister::all();

        $pdf = \PDF::loadView('registrations.all_report', compact('reports'))->setPaper('a4', 'landscape');

        return $pdf->stream('all_report.pdf');
    }

    public function exportExcel(){
        return Excel::download(new RegistrationsExport, 'reporte_general.xlsx');
    }

    public function destroy(Request $request){
        $registration = Registration::where('detail_register_id', $request->registration_id)->first();
        if ($registration) {

            $detailRegister = DetailRegister::findOrFail($registration->detail_register_id);

            $detailRegister->mount -= $request->mount_update;

            if ($detailRegister->method_payment == 1) {
                $detailRegister->method_payment = 0;
            }

            $detailRegister->save();
            $registration->delete();

            flash()->addSuccess('Pago eliminado exitosamente', 'Muy Bien!');
        } else {
            flash()->addError('No se encontró el pago para eliminar', 'Error');
        }
        return redirect()->back();
    }
}
