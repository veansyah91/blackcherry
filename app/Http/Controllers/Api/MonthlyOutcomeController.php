<?php

namespace App\Http\Controllers\api;

use App\Models\DailyOutcome;
use Illuminate\Http\Request;
use App\Models\MonthlyOutcome;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class MonthlyOutcomeController extends Controller
{
    public function index(){
        
        $monthlyOutcome = MonthlyOutcome::orderBy('created_at', 'desc')->get();

        $response = [
            'message' => 'Berhasil Mendapatkan Data Pengeluaran Bulanan',
            'data' => $monthlyOutcome,
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }

    public function update(Request $request){

        // validasi disini 
        $validated = $request->validate([
            'mulai' => 'required',
            'akhir' => 'required',
        ]);

        $jumlah = DailyOutcome::whereBetween('tanggal', [$request->mulai, $request->akhir])->sum('jumlah');


        $update = MonthlyOutcome::updateOrInsert(
                    ['bulan' => $request->bulan, 'tahun' => $request->tahun],
                    ['jumlah' => $jumlah]
                );

        $response = [
            'message' => 'Berhasil Mengubah Data Pengeluaran Bulanan',
            'data' => $update,
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }
}
