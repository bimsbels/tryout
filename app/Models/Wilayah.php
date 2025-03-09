<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    use HasFactory;

    protected $table = 'wilayah';

    protected $primaryKey = 'kode';
    
    // Tentukan bahwa primary key adalah string, bukan integer
    public $incrementing = false;
    protected $keyType = 'string';
    
    // Matikan timestamps jika tabel tidak memiliki kolom created_at dan updated_at
    public $timestamps = false;
}