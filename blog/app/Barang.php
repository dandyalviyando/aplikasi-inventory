<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = ['namabarang', 'satuan_id', 'hargamodal'];

    public function satuan()
    {
        return $this->belongsTo('App\Satuan', 'satuan_id');
    }
}
