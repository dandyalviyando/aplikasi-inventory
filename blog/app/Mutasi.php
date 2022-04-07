<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    protected $fillable = ['tanggal','quantity', 'barang_id', 'gudang_asal_id', 'gudang_tujuan_id'];

    public function barang()
    {
        return $this->belongsTo('App\Barang', 'barang_id');
    }

    public function gudangAsal()
    {
        return $this->belongsTo('App\Gudang', 'gudang_asal_id');
    }

    public function gudangTujuan()
    {
        return $this->belongsTo('App\Gudang', 'gudang_tujuan_id');
    }
}
