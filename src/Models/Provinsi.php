<?php

namespace Karomap\Indonesia\Models;

class Provinsi extends Model
{
    protected $table = 'provinsi';

    public function kokab()
    {
        return $this->hasMany('Karomap\Indonesia\Models\Kokab', 'kode_provinsi', 'kode');
    }

    public function kecamatan()
    {
        return $this->hasManyThrough(
            'Karomap\Indonesia\Models\Kecamatan',
            'Karomap\Indonesia\Models\Kokab',
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
