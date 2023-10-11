<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Course;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all()->count();
        $clients = Client::all()->count();
        $inscriptions = Registration::all()->count();
        $courses = Course::all()->count();
        return view('dashboard.index', compact('users', 'clients', 'inscriptions', 'courses'));
    }
}
