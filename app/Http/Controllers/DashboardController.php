<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Course;
use App\Models\DetailRegister;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all()->count();
        $clients = Client::all()->count();
        $inscriptions = DetailRegister::all()->count();
        $courses = Course::all()->count();
        $inscriptionsStatePartial = DetailRegister::where('method_payment', 0)->count();
        $inscriptionsStateComplete = DetailRegister::where('method_payment', 1)->count();


        return view('dashboard.index', compact('users', 'clients', 'inscriptions', 'courses', 'inscriptionsStatePartial', 'inscriptionsStateComplete'));
    }
}
