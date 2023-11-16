<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Course;
use App\Models\DetailRegister;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = DetailRegister::with('client', 'course')->get();
        $courses = Course::where('status', '1')->get();
        return view('reports.index', compact('courses', 'reports'));
    }
    public function getVersion(Request $request)
    {
        $course_id = $request->input('course_id');

        $detailRegisters = DetailRegister::whereHas('course', function ($query) use ($course_id) {
            $query->where('id', $course_id);
        })->get();

        $clientIds = $detailRegisters->pluck('client_id')->unique();
        $clients = Client::whereIn('id', $clientIds)->get();

        // Obtener información del curso seleccionado
        $selectedCourse = Course::find($course_id);

        $pdf = \PDF::loadView('reports.version', compact('clients', 'detailRegisters', 'selectedCourse'));
        return $pdf->stream('version.pdf');
    }
}
