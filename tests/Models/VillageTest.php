<?php

namespace Karomap\Indonesia\Test\Models;

use Karomap\Indonesia\Models\Kecamatan;
use Karomap\Indonesia\Models\Desa;
use Karomap\Indonesia\Test\TestCase;

class VillageTest extends TestCase
{
    /** @test */
    public function a_village_has_belongs_to_distict_relation()
    {
        $this->seed('Karomap\Indonesia\Seeds\KecamatanSeeder');
        $this->seed('Karomap\Indonesia\Seeds\DesaSeeder');

        $village = Desa::first();

        $this->assertInstanceOf(Kecamatan::class, $village->district);
        $this->assertEquals($village->district_code, $village->district->code);
    }

    /** @test */
    public function a_village_has_name_attribute()
    {
        $this->seed('Karomap\Indonesia\Seeds\DesaSeeder');

        $village = Desa::first();

        $this->assertEquals('KEUDE BAKONGAN', $village->name);
    }

    /** @test */
    public function a_village_has_district_name_attribute()
    {
        $this->seed('Karomap\Indonesia\Seeds\KecamatanSeeder');
        $this->seed('Karomap\Indonesia\Seeds\DesaSeeder');

        $village = Desa::first();

        $this->assertEquals('BAKONGAN', $village->district_name);
    }

    /** @test */
    public function a_village_has_city_name_attribute()
    {
        $this->seed('Karomap\Indonesia\Seeds\KokabSeeder');
        $this->seed('Karomap\Indonesia\Seeds\KecamatanSeeder');
        $this->seed('Karomap\Indonesia\Seeds\DesaSeeder');

        $village = Desa::first();

        $this->assertEquals('KABUPATEN ACEH SELATAN', $village->city_name);
    }

    /** @test */
    public function a_village_has_province_name_attribute()
    {
        $this->seed('Karomap\Indonesia\Seeds\ProvincesSeeder');
        $this->seed('Karomap\Indonesia\Seeds\KokabSeeder');
        $this->seed('Karomap\Indonesia\Seeds\KecamatanSeeder');
        $this->seed('Karomap\Indonesia\Seeds\DesaSeeder');

        $village = Desa::first();

        $this->assertEquals('ACEH', $village->province_name);
    }

    /** @test */
    public function a_village_can_store_meta_column()
    {
        $this->seed('Karomap\Indonesia\Seeds\DesaSeeder');

        $village = Desa::first();
        $village->meta = ['luas_wilayah' => 200.2];
        $village->save();

        $this->assertEquals(['luas_wilayah' => 200.2], $village->meta);
    }
}
