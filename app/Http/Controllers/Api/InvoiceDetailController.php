<?php

namespace App\Http\Controllers\api;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\InvoiceDetail;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class InvoiceDetailController extends Controller
{
    public function index(Invoice $invoice)
    {
        $invoiceDetails = InvoiceDetail::where('invoice_id', $invoice->id)->get();

        $response = [
            'message' => 'Berhasil Mendapatkan Detail Invoice',
            'data' => $invoiceDetails
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }

    public function destroy(InvoiceDetail $invoiceDetail){

        $invoiceDetail->delete();

        $response = [
            'message' => 'Berhasil Menghapus Detail Invoice',
            'data' => $invoiceDetail
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }
}
