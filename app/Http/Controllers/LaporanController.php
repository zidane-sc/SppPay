<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Siswa;
use App\Spp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use PDF;

class LaporanController extends Controller
{
    public function siswa(Request $request)
    {
        if (Gate::denies('laporan')) {
            abort(403);
        }

        $filter = $request->get('filter');

        $data['main'] = Siswa::all();
        $data['kelas'] = Kelas::all();

        if ($filter) {
            $data['main'] = Siswa::with('kelas')->where('kelas_id', '=', $filter)->get();
        }


        return view('laporan.siswa', [
            'data' => $data
        ]);
    }

    public function siswaCetak(Request $request)
    {
        if (Gate::denies('laporan')) {
            abort(403);
        }

        $siswas = Siswa::all();

        $filter = $request->get('filter');

        if ($filter) {
            $siswas = Siswa::with('kelas')->where('kelas_id', '=', $filter)->get();
        }

        $pdf = PDF::loadview('laporan.siswa_pdf', [
            'siswas' => $siswas,
        ]);
    	return $pdf->stream();
    }

    public function spp(Request $request)
    {
        if (Gate::denies('laporan')) {
            abort(403);
        }

        $filter = $request->get('filter');

        $data['main'] = Spp::with(['siswas'])->get();
        if ($filter) {
            $data['main'] = Spp::where('bulan', date("Y-m-d", strtotime($filter)))->with(['siswas'])->get();
        }

        return view('laporan.spp', [
            'data' => $data
        ]);
    }

    public function sppCetak(Request $request)
    {
        if (Gate::denies('laporan')) {
            abort(403);
        }
        
        $spps = Spp::all();
        $filter = $request->get('filter');

        if ($filter) {
            $spps = Spp::where('bulan', date("Y-m-d", strtotime($filter)))->with(['siswas'])->get();
        }

        $pdf = PDF::loadview('laporan.spp_pdf', [
            'spps' => $spps,
        ]);
    	return $pdf->stream();
    }
}
