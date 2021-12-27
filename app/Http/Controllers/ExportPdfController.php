<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use PDF;

class ExportPdfController extends Controller
{
    public function exportCustomers() {
        $customers = Customer::with(['hobbies'])->get();
        $pdf = PDF::loadView('customerspdf', compact('customers'));
        return $pdf->download('customers.pdf');
    }
}
