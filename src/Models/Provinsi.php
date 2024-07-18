<?php

namespace Badak\Indonesia\Models;

class Provinsi extends Model
{
    protected $table = 'provinsi';

    public $timestamps = false;

    public function kokab()
    {
        return $this->hasMany('Badak\Indonesia\Models\Kokab', 'kode_provinsi', 'kode');
    }

    public function kecamatan()
    {
        return $this->hasManyThrough(
            'Badak\Indonesia\Models\Kecamatan',
            'Badak\Indonesia\Models\Kokab',
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
