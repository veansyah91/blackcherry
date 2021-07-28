<?php

namespace App\Http\Controllers\api;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\DailyIncome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class InvoiceCollection
{
    public $nomorNota;
    public $nama;
    public $jumlah;
    public $details;
    public $invoiceId;
}

class DailyIncomeController extends Controller
{
    public function index(Request $request)
    {
        $start = $request->query()['start'];

        $dailyIncomes = DailyIncome::skip($start)->take(7)->orderBy('tanggal', 'desc')->get();

        $response = [
            'message' => 'Berhasil Mengambil Data Pemasukan Harian',
            'data' =>$dailyIncomes,
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }

    public function countData()
    {
        $countData = DailyIncome::get()->count();

        $response = [
            'message' => 'Berhasil Mengambil Banyak Data Pemasukan Harian',
            'data' =>$countData,
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }

    public function update(Request $request)
    {
        // validasi disini 
        $validated = $request->validate([
            'tanggal' => 'required',
        ]);
        
        $getTotalDailyIncome = Invoice::where('tanggal', $request->tanggal)->where('status', 'sudah')->sum('jumlah');

        $dailyIncomes = DailyIncome::updateOrInsert(
                            ['tanggal' => $request->tanggal],
                            ['jumlah' => $getTotalDailyIncome]
                        );

        $response = [
            'message' => 'Berhasil Mengupdate Data Pemasukan Harian',
            'data' => $getTotalDailyIncome,
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }

    }

    public function show(DailyIncome $dailyIncome)
    {
        $invoices = Invoice::where('tanggal', $dailyIncome->tanggal)
                            ->where('status', 'sudah')
                            ->get();

        $invoiceCollections = [];
        $i = 0;

        foreach ($invoices as $invoice) {
            $invoiceCollections[$i] = new InvoiceCollection;
            $invoiceCollections[$i]->nama = $invoice->customer->nama;
            $invoiceCollections[$i]->nomorNota = $invoice->nomor;
            $invoiceCollections[$i]->invoiceId = $invoice->id;
            $invoiceCollections[$i]->jumlah = $invoice->jumlah;
            $invoiceCollections[$i]->details = InvoiceDetail::where('invoice_id', $invoice->id)->get();

            $i++;
        }

        $response = [
            'message' => 'Berhasil Mendapatkan Data Pemasukan Harian',
            'data' => $invoiceCollections,
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }
}
