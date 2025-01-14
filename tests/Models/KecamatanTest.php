<?php

namespace Badak\Indonesia\Test\Models;

use Badak\Indonesia\Models\Desa;
use Badak\Indonesia\Models\Kecamatan;
use Badak\Indonesia\Models\Kokab;
use Badak\Indonesia\Test\TestCase;
use Illuminate\Database\Eloquent\Collection;

class KecamatanTest extends TestCase
{
    /** @test */
    public function a_district_has_belongs_to_city_relation()
    {
        $this->seed('Badak\Indonesia\Seeds\KokabSeeder');
        $this->seed('Badak\Indonesia\Seeds\KecamatanSeeder');

        $kecamatan = Kecamatan::first();

        $this->assertInstanceOf(Kokab::class, $kecamatan->kokab);
        $this->assertEquals($kecamatan->kode_kokab, $kecamatan->kokab->kode);
    }

    /** @test */
    public function a_district_has_many_villages_relation()
    {
        $this->seed('Badak\Indonesia\Seeds\KecamatanSeeder');
        $this->seed('Badak\Indonesia\Seeds\DesaSeeder');

        $kecamatan = Kecamatan::first();

        $this->assertInstanceOf(Collection::class, $kecamatan->desa);
        $this->assertInstanceOf(Desa::class, $kecamatan->desa->first());
    }

    /** @test */
    public function a_district_has_name_attribute()
    {
        $this->seed('Badak\Indonesia\Seeds\KecamatanSeeder');

        $kecamatan = Kecamatan::first();

        $this->assertEquals('Bakongan', $kecamatan->nama);
    }

    /** @test */
    public function a_district_has_city_name_attribute()
    {
        $this->seed('Badak\Indonesia\Seeds\KokabSeeder');
        $this->seed('Badak\Indonesia\Seeds\KecamatanSeeder');

        $kecamatan = Kecamatan::first();

        $this->assertEquals('Aceh Selatan', $kecamatan->nama_kokab);
    }

    /** @test */
    public function a_district_has_province_name_attribute()
    {
        $this->seed('Badak\Indonesia\Seeds\ProvinsiSeeder');
        $this->seed('Badak\Indonesia\Seeds\KokabSeeder');
        $this->seed('Badak\Indonesia\Seeds\KecamatanSeeder');

        $kecamatan = Kecamatan::first();

        $this->assertEquals('Aceh (NAD)', $kecamatan->nama_provinsi);
    }
}
