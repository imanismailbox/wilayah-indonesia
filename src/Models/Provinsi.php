<?php

namespace Itik\Indonesia\Models;

class Provinsi extends Model
{
    protected $table = 'provinsi';

    public function kokab()
    {
        return $this->hasMany('Itik\Indonesia\Models\Kokab', 'kode_provinsi', 'kode');
    }

    public function kecamatan()
    {
        return $this->hasManyThrough(
            'Itik\Indonesia\Models\Kecamatan',
            'Itik\Indonesia\Models\Kokab',
            'kode_provinsi',
            'kode_kokab',
            'kode',
            'kode'
        );
    }

    public function getAddressAttribute()
    {
        return sprintf(
            '%s, Indonesia',
            $this->nama
        );
    }
}
