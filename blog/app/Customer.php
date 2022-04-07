<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['kodecustomer', 'namacustomer', 'alamat', 'kota', 'telepon', 'email'];
}
