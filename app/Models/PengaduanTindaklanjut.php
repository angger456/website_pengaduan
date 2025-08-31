<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaduanTindaklanjut extends Model
{
    protected $table = 'pengaduan_tindaklanjut'; // nama tabel sesuai migration
    protected $fillable = ['pengaduan_id', 'keterangan'];
}


