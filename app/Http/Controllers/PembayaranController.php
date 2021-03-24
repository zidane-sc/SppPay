<?php

namespace App\Http\Controllers;

use App\Pembayaran;
use App\Siswa;
use App\Spp;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use PDF;

class PembayaranController extends Controller
{
    
    public function create(Request $request)
    {
        if (Gate::denies('index-pembayaran')) {
            abort(403);
        }

        $data = [];
        if ($request->get('search') != "") {
            $data['siswa'] = Siswa::where('nis', '=', $request->get('search'))->orWhere('nama', '=', $request->get('search'))->first();

            if ($data['siswa'] != null) {
                $data['spps'] =  $data['siswa']->with(['kelas.spps'])
                ->where('nis', '=', $request->get('search'))->orWhere('nama', '=', $request->get('search'))
                ->get();
            }


            if ($request->get('id_spp') != "") {
                $data['spp'] = Spp::findOrFail($request->get('id_spp'));
            }
        }

        return view('pembayaran.create', [
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        if (Gate::denies('create-pembayaran')) {
            abort(403);
        }

        $validateData = $request->validate([
            'bayar'   => 'required'
        ]);

        $pembayaran = new Pembayaran();      
        $pembayaran->no_transaksi = $request->get('siswa_id') . $request->get('spp_id') . Auth::user()->id . date('His');
        $pembayaran->siswa_id = $request->get('siswa_id');
        $pembayaran->spp_id = $request->get('spp_id');
        $pembayaran->user_id =  Auth::user()->id;
        $pembayaran->nominal =  $request->get('nominal');
        $pembayaran->bayar =  $validateData['bayar'];
        if ($pembayaran->bayar < $pembayaran->nominal) {
            return redirect()->route('pembayaran.create', ['search' => $request->get('search'), 'id_spp' => $pembayaran->spp_id])->with('gagal', 'spp unsuccessfully bayar');
        }
        $pembayaran->kembalian = $pembayaran->bayar - $pembayaran->nominal;
        $pembayaran->waktu_pembayaran = date('Y-m-d H:i:s');

        $pembayaran->save();

        return redirect()->route('pembayaran.create', ['search' => $request->get('search'), 'id_spp' => $pembayaran->spp_id])->with('bayar', 'spp successfully bayar');
    }

    public function show(Request $request, $ids)
    {
        if (Gate::denies('index-pembayaran')) {
            abort(403);
        }

        $id = $request->get('id');
        $idspp = $request->get('idspp');
        
        $spp = Siswa::findOrFail($id)->with(['kelas.spps', 'spps' => function($q) use($idspp) {
            $q->where("spp_id", $idspp);
        }])
        ->where('id', $id)
        ->first();

        $user = User::findOrFail($spp->spps[0]->pivot->user_id);

        return view('pembayaran.show',['spp' => $spp, 'user' => $user]);
    }

    public function cetakBukti(Request $request)
    {
        if (Gate::denies('index-pembayaran')) {
            abort(403);
        }
        
        $id = $request->get('id');
        $idspp = $request->get('idspp');

        $spp = Siswa::findOrFail($id)->with(['kelas.spps', 'spps' => function($q) use($idspp) {
            $q->where("spp_id", $idspp);
        }])
        ->where('id', $id)
        ->first();

        $user = User::findOrFail($spp->spps[0]->pivot->user_id);

        $pdf = PDF::loadview('pembayaran.bukti_pdf', [
            'spp' => $spp,
            'user' => $user,
        ]);
    	return $pdf->stream();
    }
}
