<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $fillable = ['tanggal','notapenjualan', 'hargajual', 'quantity', 'barang_id', 'gudang_id', 'customer_id'];

    public function barang()
    {
        return $this->belongsTo('App\Barang', 'barang_id');
    }

    public function gudang()
    {
        return $this->belongsTo('App\Gudang', 'gudang_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }
}
