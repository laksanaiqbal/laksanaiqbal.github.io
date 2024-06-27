<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutModel extends Model
{
    protected $table = 'newporto.abouts'; // Sesuaikan dengan nama tabel Anda
    protected $primaryKey = 'id'; // Tentukan primary key yang digunakan

    protected $fillable = ['content'];
}
