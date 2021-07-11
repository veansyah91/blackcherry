<?php

namespace App\Http\Controllers\api;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\InvoiceDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class InvoiceController extends Controller
{
    public function getToday()
    {
        $date = Date('Y-m-d');

        $invoices = DB::table('invoices')
                        ->join('customers', 'invoices.customer_id', '=', 'customers.id')
                        ->where('invoices.tanggal', $date)
                        ->select('invoices.id','invoices.nomor', 'invoices.jumlah', 'invoices.status', 'customers.nama')
                        ->get();

        $response = [
            'message' => 'Berhasil Mendapatkan Invoice Hari Ini',
            'data' => $invoices,
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }

    public function getInvoiceNumber()
    {
        $lastNumberInvoice = Invoice::select('nomor')->orderBy('created_at', 'desc')->first();
        
        $response = [
            'message' => 'Berhasil Mendapatkan Nomor Invoice',
            'data' => $lastNumberInvoice,
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }

    public function store(Request $request)
    {
        $date = Date('Y-m-d');

        // buat atau update note dengan nomor yang sama
        // cek dahulu nomor nota
        $cekNota = Invoice::where('nomor', $request->nomorNota)->first();

        // jika belum ada nota maka buat baru
        if (!$cekNota) {
            $cekNota = Invoice::create([
                'tanggal' => $date,
                'nomor' => $request->nomorNota,
                'status' => 'belum',
                'customer_id' => $request->idPelanggan
            ]);
        }

        // masukkan detail invoice
        $inputDetailInvoice = InvoiceDetail::create([
            'invoice_id' => $cekNota->id,
            'product_id' => $request->idProduk,
            'nama_produk' => $request->namaProduk,
            'jumlah' => $request->qty,
            'harga' => $request->inputHarga
        ]);

        $response = [
            'message' => 'Berhasil Mendapatkan Nomor Invoice',
            'data' => $cekNota
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }

    public function updateStatus(Request $request)
    {
        $invoice = Invoice::where('nomor', $request->nomorNota)->first();

        $getTotals = InvoiceDetail::where('invoice_id', $invoice->id)->get();

        $total = 0;

        foreach ($getTotals as $getTotal) {
            $total += $getTotal->jumlah * $getTotal->harga;
        }

        $invoice->update([
            'status' => "sudah",
            'jumlah' => $total
        ]);

        $response = [
            'message' => 'Berhasil Mengubah Invoice',
            'data' => $invoice
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }
}
