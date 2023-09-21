<?php

namespace Badak\Indonesia\Test\Models;

use Illuminate\Database\Eloquent\Collection;
use Badak\Indonesia\Models\Kokab;
use Badak\Indonesia\Models\Kecamatan;
use Badak\Indonesia\Models\Provinsi;
use Badak\Indonesia\Test\TestCase;

class ProvinceTest extends TestCase
{
    /** @test */
    public function a_province_has_many_cities_relation()
    {
        $this->seed('Badak\Indonesia\Seeds\ProvinsiSeeder');
        $this->seed('Badak\Indonesia\Seeds\KokabSeeder');

        $province = Provinsi::first();

        $this->assertInstanceOf(Collection::class, $province->cities);
        $this->assertInstanceOf(Kokab::class, $province->cities->first());
    }

    /** @test */
    public function a_province_has_many_districts_relation()
    {
        $this->seed('Badak\Indonesia\Seeds\ProvinsiSeeder');
        $this->seed('Badak\Indonesia\Seeds\KokabSeeder');
        $this->seed('Badak\Indonesia\Seeds\KecamatanSeeder');

        $province = Provinsi::first();

        $this->assertInstanceOf(Collection::class, $province->districts);
        $this->assertInstanceOf(Kecamatan::class, $province->districts->first());
    }

    /** @test */
    public function a_province_has_name_attribute()
    {
        $this->seed('Badak\Indonesia\Seeds\ProvinsiSeeder');

        $province = Provinsi::first();

        $this->assertEquals('ACEH', $province->name);
    }

    /** @test */
    public function a_province_has_logo_path_attribute()
    {
        $this->seed('Badak\Indonesia\Seeds\ProvinsiSeeder');

        $province = Provinsi::first();

        $this->assertNull($province->logo_path);
    }

    /** @test */
    public function a_province_can_store_meta_column()
    {
        $this->seed('Badak\Indonesia\Seeds\ProvinsiSeeder');

        $province = Provinsi::first();
        $province->meta = ['luas_wilayah' => 200.2];
        $province->save();

        $this->assertEquals(['luas_wilayah' => 200.2], $province->meta);
    }
}
