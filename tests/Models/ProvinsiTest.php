<?php

namespace Badak\Indonesia\Test\Models;

use Badak\Indonesia\Models\Kecamatan;
use Badak\Indonesia\Models\Kokab;
use Badak\Indonesia\Models\Provinsi;
use Badak\Indonesia\Test\TestCase;
use Illuminate\Database\Eloquent\Collection;

class ProvinsiTest extends TestCase
{
    /** @test */
    public function a_province_has_many_cities_relation()
    {
        $this->seed('Badak\Indonesia\Seeds\ProvinsiSeeder');
        $this->seed('Badak\Indonesia\Seeds\KokabSeeder');

        $provinsi = Provinsi::first();

        $this->assertInstanceOf(Collection::class, $provinsi->kokab);
        $this->assertInstanceOf(Kokab::class, $provinsi->kokab->first());
    }

    /** @test */
    public function a_province_has_many_districts_relation()
    {
        $this->seed('Badak\Indonesia\Seeds\ProvinsiSeeder');
        $this->seed('Badak\Indonesia\Seeds\KokabSeeder');
        $this->seed('Badak\Indonesia\Seeds\KecamatanSeeder');

        $provinsi = Provinsi::first();

        $this->assertInstanceOf(Collection::class, $provinsi->kecamatan);
        $this->assertInstanceOf(Kecamatan::class, $provinsi->kecamatan->first());
    }

    /** @test */
    public function a_province_has_name_attribute()
    {
        $this->seed('Badak\Indonesia\Seeds\ProvinsiSeeder');

        $provinsi = Provinsi::first();

        $this->assertEquals('Aceh (NAD)', $provinsi->nama);
    }
}
