<?php

namespace Badak\Indonesia\Models;

class Kokab extends Model
{
    protected $table = 'kokab';
    protected $searchableColumns = ['kode', 'nama', 'provinsi.nama'];
    public $timestamps = false;

    public function provinsi()
    {
        return $this->belongsTo('Badak\Indonesia\Models\Provinsi', 'kode_provinsi', 'kode');
    }

    public function kecamatan()
    {
        return $this->hasMany('Badak\Indonesia\Models\Kecamatan', 'kode_kokab', 'kode');
    }

    public function villages()
    {
        return $this->hasManyThrough(
            'Badak\Indonesia\Models\Desa',
            'Badak\Indonesia\Models\Kecamatan',
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
