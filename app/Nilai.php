<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nilai extends Model
{
    protected $table = 'tbl_nilai';
    protected $fillable = [
        'nisn_siswa',
        'id_mapel',
        'nilai_keterampilan',
        'nilai_pengetahuan'
    ];

    public $timestamps = false;

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'nisn_siswa', 'nisn');
    }

    public function mapel(): BelongsTo
    {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id');
    }
}
