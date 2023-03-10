<?php

namespace App\Http\Controllers;

use App\Models\TopUp;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TopUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TopUp $topUp)
    {
        //
        $data = $topUp->latest('id_top_up')->get();
        return view('top-up.index', compact('data'));
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
    public function store(Request $request, TopUp $topUp)
    {
        //
        $validator = Validator::make($request->all(), [
            'id_pengguna' => 'required',
            'jumlah_top_up' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $request['status_top_up'] = 0;
        $request['tanggal_top_up'] = Carbon::now();

        $topUp->create($request->all());
        
        return response()->json(['message' => 'Proses Top Up Berhasil.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TopUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function show(TopUp $topUp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TopUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function edit(TopUp $topUp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TopUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TopUp $topUp)
    {
        //
        $pengguna = $topUp->id_pengguna;
        (int)$saldoTopUp = $topUp->jumlah_top_up;

        $akunPengguna = DB::table('pengguna')
                    ->where('id_pengguna', $pengguna);

        (int)$saldoPengguna = $akunPengguna->value('sisa_saldo');
        $saldoPengguna += $saldoTopUp;
        try{
            DB::beginTransaction();
                // Update Status Top Up
                $topUp->status_top_up = 1;
                $topUp->tanggal_top_up = Carbon::now();
                $topUp->save();

                // Update Sisa Saldo Pengguna
                $akunPengguna->update(['sisa_saldo' => $saldoPengguna]);
            DB::commit();
        }catch(Exception $er){
            DB::rollBack();
            Session::flash('notify', $er);
            return redirect()->back();
        }
        //Session::flash('notify', 'Berhasil Update Saldo Pengguna'); // Web Routes Session
        return redirect()->back();
        

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TopUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function destroy(TopUp $topUp)
    {
        //
    }
}
