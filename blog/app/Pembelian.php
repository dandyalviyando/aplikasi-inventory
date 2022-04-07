<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $fillable = ['tanggal','notapembelian', 'quantity', 'supplier_id', 'barang_id', 'gudang_id'];

    public function supplier()
    {
        return $this->belongsTo('App\Supplier', 'supplier_id');
    }

    public function barang()
    {
        return $this->belongsTo('App\Barang', 'barang_id');
    }

    public function gudang()
    {
        return $this->belongsTo('App\Gudang', 'gudang_id');
    }
}
