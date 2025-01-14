<?php

namespace Badak\Indonesia\Test\Models;

use Badak\Indonesia\Models\Desa;
use Badak\Indonesia\Models\Kecamatan;
use Badak\Indonesia\Test\TestCase;

class DesaTest extends TestCase
{
    /** @test */
    public function a_village_has_belongs_to_distict_relation()
    {
        $this->seed('Badak\Indonesia\Seeds\KecamatanSeeder');
        $this->seed('Badak\Indonesia\Seeds\DesaSeeder');

        $desa = Desa::first();

        $this->assertInstanceOf(Kecamatan::class, $desa->kecamatan);
        $this->assertEquals($desa->kode_kecamatan, $desa->kecamatan->kode);
    }

    /** @test */
    public function a_village_has_name_attribute()
    {
        $this->seed('Badak\Indonesia\Seeds\DesaSeeder');

        $desa = Desa::first();

        $this->assertEquals('Keude Bakongan', $desa->nama);
    }

    /** @test */
    public function a_village_has_district_name_attribute()
    {
        $this->seed('Badak\Indonesia\Seeds\KecamatanSeeder');
        $this->seed('Badak\Indonesia\Seeds\DesaSeeder');

        $desa = Desa::first();

        $this->assertEquals('Bakongan', $desa->nama_kecamatan);
    }

    /** @test */
    public function a_village_has_city_name_attribute()
    {
        $this->seed('Badak\Indonesia\Seeds\KokabSeeder');
        $this->seed('Badak\Indonesia\Seeds\KecamatanSeeder');
        $this->seed('Badak\Indonesia\Seeds\DesaSeeder');

        $desa = Desa::first();

        $this->assertEquals('Aceh Selatan', $desa->nama_kokab);
    }

    /** @test */
    public function a_village_has_province_name_attribute()
    {
        $this->seed('Badak\Indonesia\Seeds\ProvinsiSeeder');
        $this->seed('Badak\Indonesia\Seeds\KokabSeeder');
        $this->seed('Badak\Indonesia\Seeds\KecamatanSeeder');
        $this->seed('Badak\Indonesia\Seeds\DesaSeeder');

        $desa = Desa::first();

        $this->assertEquals('Aceh (NAD)', $desa->nama_provinsi);
    }
}
