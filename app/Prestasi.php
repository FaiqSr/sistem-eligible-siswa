<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prestasi extends Model
{
    protected $table = 'tbl_prestasi_siswa';

    protected $fillable = [
        'id',
        'nisn_siswa',
        'prestasi',
        'type',
        'nama_prestasi',
        'tanggal'
    ];

    public $timestamps = false;

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'nisn_siswa', 'nisn');
    }
}
