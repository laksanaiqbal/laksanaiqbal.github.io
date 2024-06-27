<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageModel extends Model
{
    protected $table = 'newporto.message'; // Sesuaikan dengan nama tabel Anda
    protected $primaryKey = 'id_message'; // Tentukan primary key yang digunakan

    protected $fillable = ['body', 'subject'];
}
