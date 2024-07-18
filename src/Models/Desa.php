<?php

namespace Badak\Indonesia\Models;

class Desa extends Model
{
    protected $table = 'desa';

    protected $searchableColumns = ['kode', 'nama', 'kecamatan.nama'];

    public $timestamps = false;

    public function kecamatan()
    {
        return $this->belongsTo('Badak\Indonesia\Models\Kecamatan', 'kode_kecamatan', 'kode');
    }

    public function getNamaKecamatanAttribute()
    {
        return $this->kecamatan->nama;
    }

    public function getNamaKokabAttribute()
    {
        return $this->kecamatan->kokab->nama;
    }

    public function getNamaProvinsiAttribute()
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
