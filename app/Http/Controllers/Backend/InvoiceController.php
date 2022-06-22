<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class InvoiceController extends Controller
{
    public function create(Order $order)
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf = $pdf->loadView('pdf.invoice', ['order' =>  $order]);
        return $pdf->stream();
    }
}
