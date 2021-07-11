<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserRole {
    public $userId;
    public $role;
    public $userName;
}

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        
        $response = [
            'message' => 'Berhasil Mengambil Data User',
            'data' => $users,
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
            'nama' => 'required',
            'email' => ['required','email'],
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->assignRole('servant');

        $users = User::all();

        $response = [
            'message' => 'Berhasil Mengambil Data User',
            'data' => $users,
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }    
    }

    public function destroy(User $user)
    {
        $user->delete();

        $users = User::all();

        $response = [
            'message' => 'Berhasil Mengambil Data User',
            'data' => $users,
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }    
    }

    public function show(User $user)
    {
        $response = [
            'message' => 'Berhasil Mengambil Data User',
            'data' => $user,
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }    
    }

    public function update(Request $request, User $user)
    {
        // validasi disini 
        $validated = $request->validate([
            'nama' => 'required',
            'email' => ['required','email'],
            'password' => 'required',
        ]);

        $user->update([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $users = User::all();

        $response = [
            'message' => 'Berhasil Mengambil Data User',
            'data' => $users,
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }    
    }

    public function getUsersRole()
    {
        $users = User::all();

        $data = [];

        $i=0;

        foreach ($users as $user) {
            # code...
            $data[$i] = new UserRole;
            $data[$i]->userId = $user->id;
            $data[$i]->userName = $user->name;
            $data[$i]->role = $user->getRoleNames();
            $i++;
        }

        $response = [
            'message' => 'Berhasil Mengambil Data Role User',
            'data' => $data,
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }   
    }

    public function getUserRole(User $user)
    {

        $data = new UserRole;
        $data->userId = $user->id;
        $data->userName = $user->name;
        $data->role = $user->getRoleNames();

        $response = [
            'message' => 'Berhasil Mengambil Data Role User',
            'data' => $data,
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }   
    }

    public function setUserRole(User $user, Request $request)
    {
        $user->assignRole($request->role);

        $response = [
            'message' => 'Berhasil Mengambil Data Role User',
            'data' => $user,
        ];

        try {
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }   
    }
}
