<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FeedController extends Controller
{
    public function index()
    {
        $feeds = Feed::get();
        return response()->json($feeds);
    }

    public function store(Request $request)
    {
        $namaResep = DB::table('resep')->where('id_resep', $request->id_resep)->value('nama_resep');
        $request['nama_resep'] = $namaResep;
        
        $validator = Validator::make($request->all(), [
            'id_pengguna' => 'required',
            'id_resep' => 'required',
            'foto_feeds' => 'required',
            'deskripsi_feeds' => 'required',
            'nama_pengguna' => 'required',
            'nama_resep' => 'required',
        ]);
        

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $feed = Feed::create([
            'id_pengguna' => $request->input('id_pengguna'),
            'id_resep' => $request->input('id_resep'),
            'foto_feeds' => $request->input('foto_feeds'),
            'komentar' => $request->input('komentar'),
            'deskripsi_feeds' => $request->input('deskripsi_feeds'),
            'nama_pengguna' => $request->input('nama_pengguna'),
            'nama_resep' => $request->input('nama_resep'),
            'tanggal_feeds' => now()
        ]);

        return response()->json($feed);
    }

    public function show($id)
    {
        $feed = Feed::find($id);

        if (!$feed) {
            return response()->json(['message' => 'Feed not found'], 404);
        }

        return response()->json($feed);
    }

    public function update(Request $request, $id)
    {
        $namaResep = DB::table('resep')->where('id_resep', $request->id_resep)->value('nama_resep');
        $request['nama_resep'] = $namaResep;
        
        $validator = Validator::make($request->all(), [
            'id_pengguna' => 'required',
            'id_resep' => 'required',
            'foto_feeds' => 'required',
            'deskripsi_feeds' => 'required',
            'nama_pengguna' => 'required',
            'nama_resep' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $feed = Feed::find($id);

        if (!$feed) {
            return response()->json(['message' => 'Feed not found'], 404);
        }

        $feed->id_pengguna = $request->input('id_pengguna');
        $feed->id_resep = $request->input('id_resep');
        $feed->foto_feeds = $request->input('foto_feeds');
        $feed->komentar = $request->input('komentar');
        $feed->deskripsi_feeds = $request->input('deskripsi_feeds');
        $feed->nama_pengguna = $request->input('nama_pengguna');
        $feed->nama_resep = $request->input('nama_resep');
        $feed->tanggal_feeds = now();
        $feed->save();

        return response()->json($feed);
    }

    public function destroy($id)
    {
        $feed = Feed::find($id);

        if (!$feed) {
            return response()->json(['message' => 'Feed not found'], 404);
        }

        $feed->delete();

        return response()->json(['message' => 'Feed deleted']);
    }
}
