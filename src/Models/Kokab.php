<?php

namespace Karomap\Indonesia\Models;

class Kokab extends Model
{
    protected $table = 'kokab';
    protected $searchableColumns = ['kode', 'nama', 'provinsi.nama'];

    public function provinsi()
    {
        return $this->belongsTo('Karomap\Indonesia\Models\Provinsi', 'kode_provinsi', 'kode');
    }

    public function kecamatan()
    {
        return $this->hasMany('Karomap\Indonesia\Models\Kecamatan', 'kode_kokab', 'kode');
    }

    public function villages()
    {
        return $this->hasManyThrough(
            'Karomap\Indonesia\Models\Desa',
            'Karomap\Indonesia\Models\Kecamatan',
            'kode_kokab',
            'kode_kecamatan',
            'kode',
            'kode'
        );
    }

    public function getProvinceNameAttribute()
    {
        return $this->provinsi->nama;
    }

    public function getAddressAttribute()
    {
        return sprintf(
            '%s, %s, Indonesia',
            $this->nama,
            $this->provinsi->nama
        );
    }
}
