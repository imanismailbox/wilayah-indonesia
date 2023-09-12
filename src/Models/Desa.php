<?php

namespace Itik\Indonesia\Models;

class Desa extends Model
{
    protected $table = 'desa';
    protected $searchableColumns = ['kode', 'nama', 'kecamatan.nama'];

    public function kecamatan()
    {
        return $this->belongsTo('Itik\Indonesia\Models\Kecamatan', 'kode_kecamatan', 'kode');
    }

    public function getDistrictNameAttribute()
    {
        return $this->kecamatan->nama;
    }

    public function getCityNameAttribute()
    {
        return $this->kecamatan->kokab->nama;
    }

    public function getProvinceNameAttribute()
    {
        return $this->kecamatan->kokab->provinsi->nama;
    }

    public function getAddressAttribute()
    {
        $this->load('kecamatan.kokab.provinsi');

        return sprintf(
            '%s, %s, %s, %s, Indonesia',
            $this->nama,
            $this->kecamatan->nama,
            $this->kecamatan->kokab->nama,
            $this->kecamatan->kokab->provinsi->nama
        );
    }
}
