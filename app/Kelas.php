<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class)->withTrashed();
    }

    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }

    public function getTotalSiswaAttribute()
    {
        $total_siswa = count($this->siswas) ?? 0;
        
        return $total_siswa;
    }

    public function spps()
    {
        return $this->belongsToMany(Spp::class);
    }
}
