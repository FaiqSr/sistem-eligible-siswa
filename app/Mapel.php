<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mapel extends Model
{
    protected $table = 'tbl_mapel';
    protected $fillable = ['nama_mapel', 'semester', 'jurusan'];

    public function rombongan(): BelongsTo
    {
        return $this->belongsTo(Rombongan::class, 'jurusan', 'id');
    }

    public function nilai(): HasMany
    {
        return $this->hasMany(Nilai::class, 'id_mapel', 'id');
    }
}
