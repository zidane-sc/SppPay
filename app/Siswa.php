<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function Spps()
    {
        return $this->belongsToMany(Spp::class)->withPivot('no_transaksi', 'user_id', 'waktu_pembayaran', 'nominal', 'bayar', 'kembalian');
    }
}
