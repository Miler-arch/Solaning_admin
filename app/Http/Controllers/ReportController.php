<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\DetailRegister;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = DetailRegister::all();
        $courses = Course::where('status', '1')->get();
        return view('reports.index', compact('courses', 'reports'));
    }
public function getVersion($course_id)
{
    $detailRegisters = DetailRegister::whereHas('course', function ($query) use ($course_id) {
        $query->where('id', $course_id);
    })->get();
    $clients = $detailRegisters->pluck('client')->unique();
    dd($clients);

    $pdf = \PDF::loadView('reports.version', compact('clients', 'detailRegisters'));
    return $pdf->stream('version.pdf');
}


}
