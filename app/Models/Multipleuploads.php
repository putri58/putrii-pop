<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multipleuploads extends Model
{
    use HasFactory;

    protected $table = 'multipleuploads';

    // SESUAIKAN DENGAN STRUKTUR TABEL
    protected $fillable = [
        'ref_table',   // Kolom yang ada di tabel  
        'ref_id',      // Kolom yang ada di tabel
    ];

    protected $primaryKey = 'id';
    public $timestamps = true;

    // Accessor untuk kompatibilitas (opsional)
    public function getFilePathAttribute()
    {
        return 'uploads/pelanggan/' . $this->filename;
    }

    public function getFileNameAttribute()
    {
        return $this->filename;
    }

    public function getFileSizeAttribute()
    {
        // Karena tidak ada kolom file_size, return null atau hitung dari storage
        return null;
    }

    public function getMimeTypeAttribute()
    {
        // Karena tidak ada kolom mime_type, return null atau deteksi dari extension
        return null;
    }
}