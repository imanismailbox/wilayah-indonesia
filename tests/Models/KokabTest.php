<?php

namespace Badak\Indonesia\Test\Models;

use Badak\Indonesia\Models\Desa;
use Badak\Indonesia\Models\Kecamatan;
use Badak\Indonesia\Models\Kokab;
use Badak\Indonesia\Models\Provinsi;
use Badak\Indonesia\Test\TestCase;
use Illuminate\Database\Eloquent\Collection;

class KokabTest extends TestCase
{
    /** @test */
    public function a_city_has_belongs_to_province_relation()
    {
        $this->seed('Badak\Indonesia\Seeds\ProvinsiSeeder');
        $this->seed('Badak\Indonesia\Seeds\KokabSeeder');

        $kokab = Kokab::first();

        $this->assertInstanceOf(Provinsi::class, $kokab->provinsi);
        $this->assertEquals($kokab->kode_provinsi, $kokab->provinsi->kode);
    }

    /** @test */
    public function a_city_has_many_districts_relation()
    {
        $this->seed('Badak\Indonesia\Seeds\KokabSeeder');
        $this->seed('Badak\Indonesia\Seeds\KecamatanSeeder');

        $kokab = Kokab::first();

        $this->assertInstanceOf(Collection::class, $kokab->kecamatan);
        $this->assertInstanceOf(Kecamatan::class, $kokab->kecamatan->first());
    }

    /** @test */
    public function a_city_has_many_villages_relation()
    {
        $this->seed('Badak\Indonesia\Seeds\KokabSeeder');
        $this->seed('Badak\Indonesia\Seeds\KecamatanSeeder');
        $this->seed('Badak\Indonesia\Seeds\DesaSeeder');

        $kokab = Kokab::first();

        $this->assertInstanceOf(Collection::class, $kokab->desa);
        $this->assertInstanceOf(Desa::class, $kokab->desa->first());
    }

    /** @test */
    public function a_city_has_name_attribute()
    {
        $this->seed('Badak\Indonesia\Seeds\KokabSeeder');

        $kokab = Kokab::first();

        $this->assertEquals('Aceh Selatan', $kokab->nama);
    }

    /** @test */
    public function a_city_has_province_name_attribute()
    {
        $this->seed('Badak\Indonesia\Seeds\ProvinsiSeeder');
        $this->seed('Badak\Indonesia\Seeds\KokabSeeder');

        $kokab = Kokab::first();

        $this->assertEquals('Aceh (NAD)', $kokab->nama_provinsi);
    }
}
