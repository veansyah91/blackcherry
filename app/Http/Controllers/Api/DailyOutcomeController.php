<?php

namespace App\Http\Controllers\api;

use App\Models\DailyOutcome;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;

class newData {
    public $tanggal;
    public $sum;
}

class newDailyOutcome{
    public $id;
    public $jumlah;
    public $keterangan;
    public $tanggal;
}

class DailyOutcomeController extends Controller
{
    public function index()
    {

        $date = Date('Y-m-d');

        $dailyOutcomes = DailyOutcome::where('tanggal', $date)->get();

        $newDailyOutcome = [];
        $i = 0;
        
        foreach ($dailyOutcomes as $dailyOutcome) {
            # code...
            $newDailyOutcome[$i] = new newDailyOutcome;
            $newDailyOutcome[$i]->id = $dailyOutcome->id;
            $newDailyOutcome[$i]->jumlah = (int)$dailyOutcome->jumlah;
            $newDailyOutcome[$i]->keterangan = $dailyOutcome->keterangan;
            $newDailyOutcome[$i]->tanggal = $dailyOutcome->tanggal;


            $i++;

        }

        $response = [
            'message' => 'Berhasil Mengambil Data Pengeluaran',
            'data' => $dailyOutcomes,
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }

    }

    public function store(Request $request){

        // validasi disini 
        $validated = $request->validate([
            'jumlah' => 'required|numeric',
            'keterangan' => 'required',
            'tanggal' => 'required'
        ]);

        $dailyOutcomes = DailyOutcome::create($request->all());

        $response = [
            'message' => 'Berhasil Menambah Data Pengeluaran',
            'data' => $request,
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }
    
    public function destroy(DailyOutcome $dailyoutcome){
        $dailyoutcome->delete();

        $response = [
            'message' => 'Berhasil Menghapus Data Pengeluaran',
            'data' => $dailyoutcome,
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }

    public function show(DailyOutcome $dailyoutcome)
    {
        $response = [
            'message' => 'Berhasil Menghapus Data Pengeluaran',
            'data' => $dailyoutcome,
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }

    public function update(Request $request, DailyOutcome $dailyoutcome){

        // validasi disini 
        $validated = $request->validate([
            'jumlah' => 'required|numeric',
            'keterangan' => 'required',
            'tanggal' => 'required'
        ]);

        $dailyoutcome->update($request->all());

        $response = [
            'message' => 'Berhasil Mengubah Data Pengeluaran',
            'data' => $dailyoutcome,
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }

    public function history(Request $request){
        $awal = $request->query()['awal'];
        $akhir = $request->query()['akhir'];
        $limit = $request->query()['limit']; 

        if ($limit > 1) {
            $dates = DailyOutcome::select('tanggal')->distinct()->limit($limit)->orderBy('tanggal', 'desc')->get();
        } else {
            $dates = DailyOutcome::select('tanggal')->whereBetween('tanggal', [$awal, $akhir])->distinct()->orderBy('tanggal', 'desc')->get();
        }        
        
        $data = [];
        $index = 0;
        foreach ($dates as $date) {
            $index++;
            $data[$index] = new newData;
            $data[$index]->tanggal = $date->tanggal;
            $data[$index]->sum = DailyOutcome::getCount($date->tanggal);
        }

        $response = [
            'message' => 'Berhasil Mengambil Data Pengeluaran',
            'data' => $data,
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }

    }

    public function detail(Request $request){
        $tanggal = $request->query()['tanggal'];

        $data = DailyOutcome::where('tanggal', $tanggal)->get();

        $response = [
            'message' => 'Berhasil Mengambil Data Pengeluaran',
            'data' => $data,
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }
}
