<?php

namespace App\Http\Controllers\api;

use App\Models\DailyIncome;
use Illuminate\Http\Request;
use App\Models\MonthlyIncome;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class MonthlyIncomeController extends Controller
{
    public function index()
    {
        $data = MonthlyIncome::all();

        $response = [
            'message' => 'Berhasil Mengubah Data Pemasukan Bulanan',
            'data' => $data,
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
            'mulai' => 'required',
            'akhir' => 'required',
        ]);

        $jumlah = DailyIncome::whereBetween('tanggal', [$request->mulai, $request->akhir])->sum('jumlah');

        $update = MonthlyIncome::updateOrInsert(
            ['bulan' => $request->bulan, 'tahun' => $request->tahun],
            ['jumlah' => $jumlah]
        );

        $response = [
            'message' => 'Berhasil Mengubah Data Pemasukan Bulanan',
            'data' => $update,
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }
}
