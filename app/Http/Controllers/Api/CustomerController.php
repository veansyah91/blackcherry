<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->query()['page'];
        $perPage = $request->query()['perPage'];
        $search = $request->query()['search'] ;
        $start = $page * $perPage - $perPage;

        $customers = Customer::where('nama','like', '%' . $search . '%')->get()->skip($start)->take($perPage);


        $response = [
            'message' => 'Berhasil Mengambil Data Pelanggan',
            'data' => $customers,
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }    
    }

    public function getAll(Request $request)
    {
        $search = $request->query()['search'];

        $customers = Customer::where('nama','like', '%' . $search . '%')->get()->count();

        $response = [
            'message' => 'Berhasil Mengambil Jumlah Data Produk',
            'data' => $customers,
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        } 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validasi disini 
        $validated = $request->validate([
            'nama' => 'required',
        ]);

        // masukkan ke database
        $customer= Customer::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        $response = [
            'message' => "Berhasil Tambah Data Pelanggan",
            'data' => $customer,
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {

        $response = [
            'message' => 'Berhasil Mengambil Data Pelanggan',
            'data' => $customer,
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->all());

        $response = [
            'message' => 'Berhasil Menghapus Data Pelanggan',
            'data' => $customer
        ];

        try {
            return response()->json($customer, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        
        $response = [
            'message' => 'Berhasil Menghapus Data Pelanggan',
            'data' => $customer
        ];

        try {
            return response()->json($customer, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }

    public function search(Request $request)
    {
        $search = $request->query()['search'];

        $customers = Customer::where('nama','like', '%' . $search . '%')->limit(5)->get();

        $response = [
            'message' => 'Berhasil Menghapus Data Pelanggan',
            'data' => $customers
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }
}
