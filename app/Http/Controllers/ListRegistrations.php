<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class ListRegistrations extends Controller
{
    public function index()
    {
        $registrationsList = Registration::all();
        return view('registrations.list_registrations', compact('registrationsList'));
    }

    public function show(string $id)
    {

    }
}
