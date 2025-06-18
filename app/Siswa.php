<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Siswa extends Model
{
    protected $table = 'tbl_siswa';

    protected $fillable = [
        'nisn',
        'namasiswa',
        'jeniskelamin',
        'jurusan'
    ];
    public $timestamps = false;

    public function prestasi(): HasMany
    {
        return $this->hasMany(Prestasi::class, 'nisn_siswa', 'nisn');
    }

    public function nilai(): HasMany
    {
        return $this->hasMany(Nilai::class, 'nisn_siswa', 'nisn');
    }

    public function rombongan(): BelongsTo
    {
        return $this->belongsTo(Rombongan::class, 'jurusan', 'id');
    }
}
