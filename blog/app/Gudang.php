<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    protected $fillable = ['kodegudang', 'namagudang', 'lokasigudang'];
    // protected $guarded = ['id'];
}
