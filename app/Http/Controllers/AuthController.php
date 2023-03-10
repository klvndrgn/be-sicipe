<?php

namespace App\Http\Controllers;

use App\Models\pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function register(Request $req)
    {

        //valdiate
        $rules = [
            'username_pengguna' => 'required|string|unique:pengguna',
            //'tanggal_lahir' => 'required|dateTime',
            'alamat_email' => 'required|string|unique:pengguna',
            'kata_sandi' => 'required|string|min:6',
            //'tanggal_lahir'=> 'required|datetime'
        ];

        $msg = [

            'username_pengguna.required' => 'Nama pengguna tidak boleh kosong',
            'kata_sandi.required'=> 'Kata sandi tidak boleh kurang dari 6 karakter',
            'username_pengguna.unique' => 'Nama pengguna sudah ada',
            'alamat_email.unique'=> 'Alamat email sudah pernah dipakai sebelumnya',
            //'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong'
        ];

        $validator = Validator::make($req->all(), $rules, $msg);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        //create new user in users table
        $pengguna = pengguna::create([
            'username_pengguna' => $req->username_pengguna,
            'alamat_email' => $req->alamat_email,
            'kata_sandi' => Hash::make($req->kata_sandi),
            //'tanggal_lahir' => $req -> tanggal_lahr
        ]);
        $token = $pengguna->createToken('Personal Access Token')->plainTextToken;
        $response = ['pengguna' => $pengguna, 'token' => $token];
        return response()->json($response, 200);
    }

    public function login(Request $req)
    {
        // validate inputs
        $rules = [
            'alamat_email' => 'required',
            'kata_sandi' => 'required|string'
        ];
        $req->validate($rules);
        // find user email in users table
        $pengguna = pengguna::where('alamat_email', $req->alamat_email)->first();
        // if pengguna email found and password is correct
        if ($pengguna && Hash::check($req->kata_sandi, $pengguna->kata_sandi)) {
            $token = $pengguna->createToken('Personal Access Token')->plainTextToken;
            $response = ['pengguna' => $pengguna, 'token' => $token];
            return response()->json($response, 200);
        }
        $response = ['message' => 'Nama Pengguna atau Password Salah'];
        return response()->json($response, 400);
    }
}
