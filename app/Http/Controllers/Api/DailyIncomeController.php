<?php

namespace App\Http\Controllers\api;

use App\Models\Invoice;
use App\Models\DailyIncome;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class DailyIncomeController extends Controller
{
    public function index(Request $request)
    {
        $start = $request->query()['start'];

        $dailyIncomes = DailyIncome::take(7)->orderBy('tanggal', 'desc')->get()->skip($start)->take(7);

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
}
