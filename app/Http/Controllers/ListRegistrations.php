<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Registration;

class ListRegistrations extends Controller
{
    public function index()
    {
        $registrationsList = Registration::orderBy('id', 'desc')->get();

        return view('registrations.list_registrations', compact('registrationsList'));
    }

    public function show(string $id)
    {

    }
}
