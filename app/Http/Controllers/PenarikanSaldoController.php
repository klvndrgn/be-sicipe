<?php

namespace App\Http\Controllers;

use App\Models\PenarikanSaldo;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PenarikanSaldoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, PenarikanSaldo $penarikanSaldo)
    {
        //
        
        $validator = Validator::make($request->all(), [
            'id_pengguna' => 'required',
            'jumlah_penarikan' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $akunPengguna = DB::table('pengguna')
                    ->where('id_pengguna', $request->id_pengguna);
        try{
            if($request->jumlah_penarikan < $akunPengguna->value('sisa_saldo')){
                DB::beginTransaction();
                $request['status_penarikan'] = 1;
                $request['tanggal_penarikan'] = Carbon::now();

                (int)$saldoPengguna = $akunPengguna->value('sisa_saldo');
                $saldoPengguna -= (int)$request->jumlah_penarikan;

                $penarikanSaldo->create($request->all());
                $akunPengguna->update(['sisa_saldo' => $saldoPengguna]);
                DB::commit();
            }else{
                return response()->json(['message' => 'Saldo Anda Tidak Cukup.']);
            }
        }catch(Exception $er){
            DB::rollBack();
            return response()->json(['message' => $er], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        return response()->json(['message' => 'Proses Penarikan Saldo Berhasil. Silahkan Cek Sisa Saldo Anda'], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PenarikanSaldo  $penarikanSaldo
     * @return \Illuminate\Http\Response
     */
    public function show(PenarikanSaldo $penarikanSaldo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PenarikanSaldo  $penarikanSaldo
     * @return \Illuminate\Http\Response
     */
    public function edit(PenarikanSaldo $penarikanSaldo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PenarikanSaldo  $penarikanSaldo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PenarikanSaldo $penarikanSaldo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PenarikanSaldo  $penarikanSaldo
     * @return \Illuminate\Http\Response
     */
    public function destroy(PenarikanSaldo $penarikanSaldo)
    {
        //
    }
}
