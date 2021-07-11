<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        
        $response = [
            'message' => 'Berhasil Mengambil Role',
            'data' => $roles,
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        } 
    }

    public function store(Request $request)
    {
        // validasi disini 
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $role = Role::create([
            'name' => $request->name
        ]);

        $response = [
            'message' => 'Berhasil Mengambil Role',
            'data' => $role,
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }   
    }

    public function delete(Role $role)
    {
        $role->delete();

        $response = [
            'message' => 'Berhasil Menghapus Role',
            'data' => $role,
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }  
    }
}
