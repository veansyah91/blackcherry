<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
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

        $products = Product::where('nama_produk','like', '%' . $search . '%')->get()->skip($start)->take($perPage);

        $response = [
            'message' => 'Berhasil Mengambil Data Produk',
            'data' => $products,
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

        $products = Product::where('nama_produk','like', '%' . $search . '%')->get()->count();

        $response = [
            'message' => 'Berhasil Mengambil Jumlah Data Produk',
            'data' => $products,
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
        //
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
            'nama_produk' => 'required',
            'kode' => 'required',
            'harga' => 'required',
        ]);

        // masukkan ke database
        $product = Product::create($request->all());

        $response = [
            'message' => "Berhasil Tambah Data Produk",
            'data' => $request->all(),
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product = Product::find($product);

        $response = [
            'message' => 'Berhasil Mengambil Data Produk',
            'data' => $product
        ];

        return response()->json($response, Response::HTTP_OK);     
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        // validasi disini 
        $validated = $request->validate([
            'nama_produk' => 'required',
            'kode' => 'required',
            'harga' => 'required',
        ]);

        // masukkan ke database
        $product = Product::find($product->id)->update($request->all());

        $response = [
            'message' => "Berhasil Ubah Data Produk",
            'data' => $request->all(),
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product = Product::find($product->id)->delete();

        $response = [
            'message' => 'Berhasil Menghapus Data Produk',
            'data' => $product
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }

    public function search(Request $request)
    {
        $search = $request->query()['search'];

        $products = Product::where('nama_produk','like', '%' . $search . '%')->limit(5)->get();

        $response = [
            'message' => 'Berhasil Mendapatkan Data Produk',
            'data' => $products
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }

    }
}
