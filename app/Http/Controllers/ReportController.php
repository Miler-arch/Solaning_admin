<?php

namespace App\Http\Controllers;

use App\Models\DetailRegister;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = DetailRegister::all();
        return view('reports.index', compact('reports'));
    }
    public function show(string $id)
    {
        //
    }
}
