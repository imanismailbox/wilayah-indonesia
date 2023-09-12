<?php

namespace Itik\Indonesia\Models;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';
    protected $searchableColumns = ['kode', 'nama', 'kokab.nama'];

    public function kokab()
    {
        return $this->belongsTo('Itik\Indonesia\Models\Kokab', 'kode_kokab', 'kode');
    }

    public function desa()
    {
        return $this->hasMany('Itik\Indonesia\Models\Desa', 'kode_kecamatan', 'kode');
    }

    public function getCityNameAttribute()
    {
        return $this->kokab->nama;
    }

    public function getProvinceNameAttribute()
    {
        return $this->kokab->provinsi->nama;
    }

    public function getAddressAttribute()
    {
        return sprintf(
            '%s, %s, %s, Indonesia',
            $this->nama,
            $this->kokab->nama,
            $this->kokab->provinsi->nama
        );
    }
}
