<?php

namespace Badak\Indonesia\Models;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';

    protected $searchableColumns = ['kode', 'nama', 'kokab.nama'];

    public $timestamps = false;

    public function kokab()
    {
        return $this->belongsTo('Badak\Indonesia\Models\Kokab', 'kode_kokab', 'kode');
    }

    public function desa()
    {
        return $this->hasMany('Badak\Indonesia\Models\Desa', 'kode_kecamatan', 'kode');
    }

    public function getNamaKokabAttribute()
    {
        return $this->kokab->nama;
    }

    public function getNamaProvinsiAttribute()
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
