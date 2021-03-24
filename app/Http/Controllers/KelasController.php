<?php

namespace App\Http\Controllers;

use App\Jurusan;
use App\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        if (Gate::denies('index-kelas')) {
            abort(403);
        }

        $filter = $request->get('filter');
        $datas = Kelas::all();

        if ($filter) {
            $datas = Kelas::where('tingkat', '=', $filter)->get();
        }

        $jurusan = Jurusan::all();

        return view('kelas.index', ['datas' => $datas, 'jurusan' => $jurusan]);
    }

    public function store(Request $request)
    {
        if (Gate::denies('create-kelas')) {
            abort(403);
        }

        $validateData = $request->validate([
            'wali_kelas'   => 'required|unique:kelas,wali_kelas',
            'tingkat'   => 'required|in:X,XI,XII',
            'no' => 'required|numeric',
            'jurusan_id' => 'required'
        ]);

        $new_kelas = new Kelas();
        
        $tingkat = $validateData['tingkat'];
        $no = $validateData['no'];
        $jurusan = Jurusan::find($validateData['jurusan_id'])->nama;
        
        $new_kelas->nama = "$tingkat $jurusan $no";
        $new_kelas->wali_kelas = $validateData['wali_kelas'];
        $new_kelas->tingkat = $tingkat;
        $new_kelas->no = $no;
        $new_kelas->jurusan_id = $validateData['jurusan_id'];

        if (Kelas::where('nama', '=', $new_kelas->nama)->exists()) {
            return redirect()->route('kelas.index')->with('failed', 'Jurusan successfully added');
        } else {
            $new_kelas->save();
            return redirect()->route('kelas.index')->with('create', 'Jurusan successfully added');
        }
        
    }

    public function edit($id)
    {
        if (Gate::denies('create-kelas')) {
            abort(403);
        }

        $datas = Kelas::all();
        $kelas = Kelas::findOrFail($id);
        $jurusan = Jurusan::all();

        return view('kelas.index', [
            'datas' => $datas,
            'kelas'  => $kelas,
            'jurusan' => $jurusan
        ]);
    }

    public function update(Request $request, $id)
    {
        if (Gate::denies('create-kelas')) {
            abort(403);
        }

        $validateData = $request->validate([
            'wali_kelas'   => 'required|unique:kelas,wali_kelas,'.$id,
            'tingkat'   => 'required|in:X,XI,XII',
            'no' => 'required|numeric',
            'jurusan_id' => 'required'
        ]);

        $kelas = Kelas::findOrFail($id);

        $tingkat = $validateData['tingkat'];
        $no = $validateData['no'];
        $jurusan = Jurusan::find($validateData['jurusan_id'])->nama;
        
        $kelas->nama = "$tingkat $jurusan $no";
        $kelas->wali_kelas = $validateData['wali_kelas'];
        $kelas->tingkat = $tingkat;
        $kelas->no = $no;
        $kelas->jurusan_id = $validateData['jurusan_id'];

        if (Kelas::where('id', '!=', $id)->where('nama', '=', $kelas->nama)->exists()) {
            return redirect()->route('kelas.index')->with('failed', 'kelas successfully added');
        } else {
            $kelas->save();
            return redirect()->route('kelas.index')->with('update', 'Kelas successfully updated');
        }
    }

    public function destroy($id)
    {
        if (Gate::denies('delete-kelas')) {
            abort(403);
        }

        $kelas = Kelas::findOrFail($id);
        $kelas->spps()->detach();
        $kelas->siswas()->delete();
        $kelas->delete();

        return redirect()->route('kelas.index')->with('delete', 'book deleted');
    }
}
