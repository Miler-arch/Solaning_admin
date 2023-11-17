<?php

namespace App\Exports;

use App\Models\DetailRegister;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class RegistrationsExport implements FromView
{

    public function view(): View
    {
        return view('registrations.export_excel', [
            'reports' => DetailRegister::all()
        ]);
    }
}
