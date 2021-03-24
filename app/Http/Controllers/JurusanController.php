<?php

namespace App\Http\Controllers;

use App\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class JurusanController extends Controller
{
    public function index()
    {
        if (Gate::denies('index-jurusan')) {
            abort(403);
        }

        $jurusans = Jurusan::all();
       
        return view('jurusans.index', ['jurusans' => $jurusans]);
    }

    public function store(Request $request)
    {
        if (Gate::denies('create-jurusan')) {
            abort(403);
        }

        $validateData = $request->validate([
            'nama'   => 'required|unique:jurusans,nama',
            'deskripsi'   => 'required',
        ]);

        $new_jurusan = new Jurusan();

        $new_jurusan->nama = $validateData['nama'];
        $new_jurusan->deskripsi = $validateData['deskripsi'];

        $new_jurusan->save();

        return redirect()->route('jurusan.index')->with('create', 'Jurusan successfully added');
    }

    public function edit($id)
    {
        if (Gate::denies('create-jurusan')) {
            abort(403);
        }

        $jurusans = Jurusan::all();
        $jurusan = Jurusan::findOrFail($id);

        return view('jurusans.index', [
            'jurusans' => $jurusans,
            'jurusan'  => $jurusan
        ]);
    }

    public function update(Request $request, $id)
    {
        if (Gate::denies('create-jurusan')) {
            abort(403);
        }

        $validateData = $request->validate([
            'nama'   => 'required|unique:jurusans,nama,'.$id,
            'deskripsi'   => 'required',
        ]);

        $jurusan = Jurusan::findOrFail($id);

        $jurusan->nama = $validateData['nama'];
        $jurusan->deskripsi = $validateData['deskripsi'];

        $jurusan->save();

        return redirect()->route('jurusan.index')->with('update', 'Jurusan successfully updated');        
    }

    public function destroy($id)
    {
        if (Gate::denies('delete-jurusan')) {
            abort(403);
        }

        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();

        return redirect()->route('jurusan.index')->with('trash', 'book moved to trash');
    }

    public function trash()
    {
        if (Gate::denies('delete-jurusan')) {
            abort(403);
        }

        $jurusans = Jurusan::onlyTrashed()->get();

        return view('jurusans.trash', [
            'jurusans' => $jurusans
        ]);
    }

    public function restore($id)
    {
        if (Gate::denies('delete-jurusan')) {
            abort(403);
        }

        $jurusan = Jurusan::withTrashed()->findOrFail($id);

        if ($jurusan->trashed()) {
            $jurusan->restore();
            
            return redirect()->route('jurusan.index')->with('restore', 'jurusan restored successfully');
        } else {
                return redirect()->route('jurusan.trash')->with('failed', 'jurusan is not in trash');
        }
        
    }

    public function deletePermanent($id)
    {
        if (Gate::denies('delete-jurusan')) {
            abort(403);
        }
        
        $jurusan = Jurusan::withTrashed()->findOrFail($id);

        if ($jurusan->trashed()) {
            $jurusan->kelas()->delete();
            $jurusan->forceDelete();
            
            return redirect()->route('jurusan.trash')->with('delete', 'jurusan delete successfully');
        } else {
            return redirect()->route('jurusan.trash')->with('failed', 'jurusan is not in trash');
        }
    }
}
