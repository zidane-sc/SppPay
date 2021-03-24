<?php

namespace App\Http\Controllers;

use App\Jurusan;
use App\Kelas;
use App\Siswa;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['user'] = count(User::all());
        $data['jurusan'] = count(Jurusan::all());
        $data['kelas'] = count(Kelas::all());
        $data['siswa'] = count(Siswa::all());
        return view('home', ['data' => $data]);
    }

    public function calender()
    {
        return view('calender');
    }
}
