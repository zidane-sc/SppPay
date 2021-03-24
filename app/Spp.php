<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    public function kelas()
    {
        return $this->belongsToMany(Kelas::class);
    }

    public function getTotalKelasAttribute()
    {
        $total_kelas = count($this->kelas) ?? 0;
        
        return $total_kelas;
    }

    public function getTotalSiswaAttribute()
    {
        $total_siswa = 0;

        foreach ($this->kelas as $key) {
            foreach ($key->siswas as $keys) {
                $total_siswa += 1;
            }
        }
        
        return $total_siswa;
    }

    public function getTotalSiswaSudahBayarAttribute()
    {
        $total_siswa = 0;

        $total_siswa = count($this->siswas()->has('spps')->get()) ?? 0;
        
        return $total_siswa;
    }

    public function siswas()
    {
        return $this->belongsToMany(Siswa::class)->withPivot('no_transaksi', 'user_id', 'waktu_pembayaran', 'nominal', 'bayar', 'kembalian');
    }

    public function user(){
        return $this->hasOne(User::class);
    }
}
