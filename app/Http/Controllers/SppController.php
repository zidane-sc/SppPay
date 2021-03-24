<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Siswa;
use App\Spp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SppController extends Controller
{
    public function index()
    {
        if (Gate::denies('index-spp')) {
            abort(403);
        }

        $spps = Spp::all();
        $kelas = Kelas::all();

        return view('spps.index', ['spps' => $spps, 'kelas' => $kelas]);
    }

    public function store(Request $request)
    {
        if (Gate::denies('create-spp')) {
            abort(403);
        }

        $validateData = $request->validate([
            'nama'   => 'required',
            'nominal'   => 'required|min:100000|numeric',
            'bulan' => 'required',
            'jatuh_tempo' => 'required|after:bulan',
            'kelas_id' => 'required',
        ]);

        $spp = new Spp();

        $spp->nama = $validateData['nama'];
        $spp->nominal = $validateData['nominal'];
        $spp->bulan =  date("Y-m-d", strtotime($validateData['bulan']));
        $spp->jatuh_tempo =  date("Y-m-d", strtotime($validateData['jatuh_tempo']));

        $spp->save();
        $spp->kelas()->attach($validateData['kelas_id']);

        return redirect()->route('spp.index')->with('create', 'spp successfully added');
    }

    public function show(Request $request, $id)
    {
        if (Gate::denies('show-spp')) {
            abort(403);
        }

        $filter = $request->get('filter');
        $status = $request->get('status');

        if ($status == "Bayar") {
            $siswas['bayar'] = Spp::find($id)->with(['kelas.siswas' => function($q) use($id) {
                $q->whereHas("spps", function($query) use($id) {
                    $query->where("spp_id", $id);
                });
            }])
            ->where('id', '=', $id)
            ->get();
        } elseif ($status == "Belum") {
            $siswas['belum'] = Spp::find($id)->with(['kelas.siswas' => function($q) use($id) {
                        $q->whereDoesntHave("spps", function($query) use($id) {
                            $query->where("spp_id", $id);
                        });
                    }])
                    ->where('id', '=', $id)
                    ->get();
        } elseif ($status == ""){
            // $siswas = Spp::find($id)->with(['kelas.siswas'])
            // ->where('id', '=', $id)
            // ->get();;

            $siswas['bayar'] = Spp::find($id)->with(['kelas.siswas' => function($q) use($id) {
                $q->whereHas("spps", function($query) use($id) {
                    $query->where("spp_id", $id);
                });
            }])
            ->where('id', '=', $id)
            ->get();
            
            $siswas['belum'] = Spp::find($id)->with(['kelas.siswas' => function($q) use($id) {
                        $q->whereDoesntHave("spps", function($query) use($id) {
                            $query->where("spp_id", $id);
                        });
                    }])
                    ->where('id', '=', $id)
                    ->get();
        }

        if ($filter) {
            $siswas['belum'] = Spp::find($id)->with(['kelas.siswas' => function($q) use($id, $filter) {
                $q->whereDoesntHave("spps", function($query) use($id, $filter) {
                    $query->where("spp_id", $id);
                });
                $q->where('kelas_id', '=', $filter);
            }])
            ->where('id', '=', $id)
            ->get();
        }

        $spp = Spp::findOrFail($id);
        return view('spps.show', [
            'spp' => $spp,
            'data' => $siswas
        ]);
    }

    public function edit($id)
    {
        if (Gate::denies('create-spp')) {
            abort(403);
        }

        $spps = Spp::all();
        $spp = Spp::findOrFail($id);
        $kelas = Kelas::all();

        return view('spps.index', [
            'spp' => $spp,
            'spps' => $spps,
            'kelas' => $kelas,
        ]);
    }

    public function update(Request $request, $id)
    {
        if (Gate::denies('create-spp')) {
            abort(403);
        }

        $validateData = $request->validate([
            'nama'   => 'required',
            'nominal'   => 'required|min:100000|numeric',
            'bulan' => 'required',
            'jatuh_tempo' => 'required|after:bulan',
            'kelas_id' => 'required',
        ]);

        $spp = Spp::findOrFail($id);
        
        $spp->nama = $validateData['nama'];
        $spp->nominal = $validateData['nominal'];
        $spp->bulan =  date("Y-m-d", strtotime($validateData['bulan']));
        $spp->jatuh_tempo =  date("Y-m-d", strtotime($validateData['jatuh_tempo']));

        $spp->save();
        $spp->kelas()->sync($validateData['kelas_id']);

        return redirect()->route('spp.index')->with('update', 'spp successfully updated');
    }

    public function destroy($id)
    {
        if (Gate::denies('delete-spp')) {
            abort(403);
        }

        $spp = Spp::findOrFail($id);
        $spp->kelas()->detach();
        $spp->delete();

        return redirect()->route('spp.index')->with('delete', 'spp deleted');
    }
}
