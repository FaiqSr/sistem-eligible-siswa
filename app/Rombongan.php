<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rombongan extends Model
{
    protected $table = 'tbl_rombongan';
    protected $fillable = [
        'rombongan'
    ];

    public $timestamps = false;

    public function siswa(): HasMany
    {
        return $this->hasMany(Siswa::class, 'jurusan', 'id');
    }

    public function mapel(): HasMany
    {
        return $this->hasMany(Mapel::class, 'jurusan', 'id');
    }
}
