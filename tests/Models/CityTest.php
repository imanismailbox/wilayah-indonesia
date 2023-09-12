<?php

namespace Itik\Indonesia\Test\Models;

use Illuminate\Database\Eloquent\Collection;
use Itik\Indonesia\Models\Kokab;
use Itik\Indonesia\Models\Kecamatan;
use Itik\Indonesia\Models\Provinsi;
use Itik\Indonesia\Models\Desa;
use Itik\Indonesia\Test\TestCase;

class CityTest extends TestCase
{
    /** @test */
    public function a_city_has_belongs_to_province_relation()
    {
        $this->seed('Itik\Indonesia\Seeds\ProvincesSeeder');
        $this->seed('Itik\Indonesia\Seeds\KokabSeeder');

        $city = Kokab::first();

        $this->assertInstanceOf(Provinsi::class, $city->province);
        $this->assertEquals($city->province_code, $city->province->code);
    }

    /** @test */
    public function a_city_has_many_districts_relation()
    {
        $this->seed('Itik\Indonesia\Seeds\KokabSeeder');
        $this->seed('Itik\Indonesia\Seeds\KecamatanSeeder');

        $city = Kokab::first();

        $this->assertInstanceOf(Collection::class, $city->districts);
        $this->assertInstanceOf(Kecamatan::class, $city->districts->first());
    }

    /** @test */
    public function a_city_has_many_villages_relation()
    {
        $this->seed('Itik\Indonesia\Seeds\KokabSeeder');
        $this->seed('Itik\Indonesia\Seeds\KecamatanSeeder');
        $this->seed('Itik\Indonesia\Seeds\DesaSeeder');

        $city = Kokab::first();

        $this->assertInstanceOf(Collection::class, $city->villages);
        $this->assertInstanceOf(Desa::class, $city->villages->first());
    }

    /** @test */
    public function a_city_has_name_attribute()
    {
        $this->seed('Itik\Indonesia\Seeds\KokabSeeder');

        $city = Kokab::first();

        $this->assertEquals('KABUPATEN ACEH SELATAN', $city->name);
    }

    /** @test */
    public function a_city_has_province_name_attribute()
    {
        $this->seed('Itik\Indonesia\Seeds\ProvincesSeeder');
        $this->seed('Itik\Indonesia\Seeds\KokabSeeder');

        $city = Kokab::first();

        $this->assertEquals('ACEH', $city->province_name);
    }

    /** @test */
    public function a_city_has_logo_path_attribute()
    {
        $this->seed('Itik\Indonesia\Seeds\KokabSeeder');

        $city = Kokab::first();

        $this->assertNull($city->logo_path);
    }

    /** @test */
    public function a_city_can_store_meta_column()
    {
        $this->seed('Itik\Indonesia\Seeds\KokabSeeder');

        $city = Kokab::first();
        $city->meta = ['luas_wilayah' => 200.2];
        $city->save();

        $this->assertEquals(['luas_wilayah' => 200.2], $city->meta);
    }
}
