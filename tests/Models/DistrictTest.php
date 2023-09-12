<?php

namespace Itik\Indonesia\Test\Models;

use Illuminate\Database\Eloquent\Collection;
use Itik\Indonesia\Models\Kokab;
use Itik\Indonesia\Models\Kecamatan;
use Itik\Indonesia\Models\Desa;
use Itik\Indonesia\Test\TestCase;

class DistrictTest extends TestCase
{
    /** @test */
    public function a_district_has_belongs_to_city_relation()
    {
        $this->seed('Itik\Indonesia\Seeds\KokabSeeder');
        $this->seed('Itik\Indonesia\Seeds\KecamatanSeeder');

        $district = Kecamatan::first();

        $this->assertInstanceOf(Kokab::class, $district->city);
        $this->assertEquals($district->city_code, $district->city->code);
    }

    /** @test */
    public function a_district_has_many_villages_relation()
    {
        $this->seed('Itik\Indonesia\Seeds\KecamatanSeeder');
        $this->seed('Itik\Indonesia\Seeds\DesaSeeder');

        $district = Kecamatan::first();

        $this->assertInstanceOf(Collection::class, $district->villages);
        $this->assertInstanceOf(Desa::class, $district->villages->first());
    }

    /** @test */
    public function a_district_has_name_attribute()
    {
        $this->seed('Itik\Indonesia\Seeds\KecamatanSeeder');

        $district = Kecamatan::first();

        $this->assertEquals('BAKONGAN', $district->name);
    }

    /** @test */
    public function a_district_has_city_name_attribute()
    {
        $this->seed('Itik\Indonesia\Seeds\KokabSeeder');
        $this->seed('Itik\Indonesia\Seeds\KecamatanSeeder');

        $district = Kecamatan::first();

        $this->assertEquals('KABUPATEN ACEH SELATAN', $district->city_name);
    }

    /** @test */
    public function a_district_has_province_name_attribute()
    {
        $this->seed('Itik\Indonesia\Seeds\ProvincesSeeder');
        $this->seed('Itik\Indonesia\Seeds\KokabSeeder');
        $this->seed('Itik\Indonesia\Seeds\KecamatanSeeder');

        $district = Kecamatan::first();

        $this->assertEquals('ACEH', $district->province_name);
    }

    /** @test */
    public function a_district_can_store_meta_column()
    {
        $this->seed('Itik\Indonesia\Seeds\KecamatanSeeder');

        $district = Kecamatan::first();
        $district->meta = ['luas_wilayah' => 200.2];
        $district->save();

        $this->assertEquals(['luas_wilayah' => 200.2], $district->meta);
    }
}
