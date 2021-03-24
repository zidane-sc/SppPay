<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        if (Gate::denies('index-siswa')) {
            abort(403);
        }

        $filter = $request->get('filter');
        $siswas = Siswa::all();
        $kelas = Kelas::all();

        if ($filter) {
            $siswas = Siswa::with('kelas')->where('kelas_id', '=', $filter)->get();
        }

        return view('siswas.index', [
            'siswas' => $siswas,
            'kelas' => $kelas
        ]);
    }

    public function create()
    {
        if (Gate::denies('create-siswa')) {
            abort(403);
        }

        $kelas = Kelas::all();

        return view('siswas.create', ['kelas' => $kelas]);
    }

    public function store(Request $request)
    {
        if (Gate::denies('create-siswa')) {
            abort(403);
        }

        $validateData = $request->validate([
            'nama'   => 'required',
            'nis'   => 'required|unique:siswas,nis',
            'kelas_id'   => 'required',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'no_telp' => 'required|numeric',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|before:today',
            'nama_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'nama_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
        ]);

        $new_siswa = new Siswa();

        $new_siswa->nama = $validateData['nama'];
        $new_siswa->nis = $validateData['nis'];
        $new_siswa->kelas_id = $validateData['kelas_id'];
        $new_siswa->jenis_kelamin = $validateData['jenis_kelamin'];
        $new_siswa->no_telp = $validateData['no_telp'];
        $new_siswa->alamat = $validateData['alamat'];
        $new_siswa->tempat_lahir = $validateData['tempat_lahir'];
        $new_siswa->tanggal_lahir = str_replace(' ', '-', $validateData['tanggal_lahir']);
        $new_siswa->nama_ayah = $validateData['nama_ayah'];
        $new_siswa->pekerjaan_ayah = $validateData['pekerjaan_ayah'];
        $new_siswa->nama_ibu = $validateData['nama_ibu'];
        $new_siswa->pekerjaan_ibu = $validateData['pekerjaan_ibu'];
     
        if ($request->file('avatar')) {
            $file = $request->file('avatar')->store('avatars', 'public');
            $new_siswa->avatar = $file;
        }

        $new_siswa->save();

        return redirect()->route('siswa.index')->with('create', 'Siswa successfully created');
    }

    public function show($id)
    {
        if (Gate::denies('show-siswa')) {
            abort(403);
        }

        $siswa = Siswa::findOrFail($id);

        return view('siswas.show', [
            'siswa' => $siswa
        ]);
    }

    public function edit($id)
    {
        if (Gate::denies('update-siswa')) {
            abort(403);
        }

        $siswa = Siswa::findOrFail($id);
        $kelas = Kelas::all();

        return view('siswas.edit', [
            'siswa' => $siswa,
            'kelas' => $kelas
        ]);
    }

    public function update(Request $request, $id)
    {
        if (Gate::denies('update-siswa')) {
            abort(403);
        }

        $validateData = $request->validate([
            'nama'   => 'required',
            'nis'   => 'required|unique:siswas,nis,'.$id,
            'kelas_id'   => 'required',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'no_telp' => 'required|numeric',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|before:today',
            'nama_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'nama_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
        ]);

        $siswa = Siswa::findOrFail($id);

        $siswa->nama = $validateData['nama'];
        $siswa->nis = $validateData['nis'];
        $siswa->kelas_id = $validateData['kelas_id'];
        $siswa->jenis_kelamin = $validateData['jenis_kelamin'];
        $siswa->no_telp = $validateData['no_telp'];
        $siswa->alamat = $validateData['alamat'];
        $siswa->tempat_lahir = $validateData['tempat_lahir'];
        $siswa->tanggal_lahir = str_replace(' ', '-', $validateData['tanggal_lahir']);
        $siswa->nama_ayah = $validateData['nama_ayah'];
        $siswa->pekerjaan_ayah = $validateData['pekerjaan_ayah'];
        $siswa->nama_ibu = $validateData['nama_ibu'];
        $siswa->pekerjaan_ibu = $validateData['pekerjaan_ibu'];

        if ($request->file('avatar')) {
            if($siswa->avatar && file_exists(storage_path('app/public/' . $siswa->avatar))) {
                Storage::delete('public/'.$siswa->avatar);
            }
            $file = $request->file('avatar')->store('avatars', 'public');
            $siswa->avatar = $file;
        }

        $siswa->save();

        return redirect()->route('siswa.index')->with('update', 'siswa succesfully updated');
    }

    public function destroy($id)
    {
        if (Gate::denies('delete-siswa')) {
            abort(403);
        }

        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('siswa.index')->with('delete', 'siswa succesfully deleted');
    }
}
