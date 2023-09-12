<?php

namespace Laravolt\Indonesia\Test;

use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;

class IndonesiaTest extends TestCase
{
    use InteractsWithDatabase;

    /** @test */
    public function it_can_call_indonesia_service()
    {
        $this->artisan('karomap:indonesia:seed');

        $this->checkProvinces();
        $this->checkCities();
        $this->checkDistricts();
        // $this->checkVillages();
        $this->search();
    }

    public function checkProvinces()
    {
        $results = \Indonesia::allProvinces();

        $this->assertNotEmpty($results);

        $results = \Indonesia::paginateProvinces();

        $this->assertEquals(count($results), 15);

        // array $with : kokab, kecamatan, desa, kokab.kecamatan, kokab.kecamatan.desa, kecamatan.desa

        $selectedProvinceId = $results[0]->id;

        $result = \Indonesia::findProvince($selectedProvinceId);

        $this->assertEquals($result->id, $selectedProvinceId);

        $result = \Indonesia::findProvince($selectedProvinceId, ['kokab']);

        $this->assertNotEmpty($result->kokab);

        $result = \Indonesia::findProvince($selectedProvinceId, ['kecamatan']);

        $this->assertNotEmpty($result->kecamatan);

        $result = \Indonesia::findProvince($selectedProvinceId, ['desa']);

        $this->assertNotEmpty($result->desa);

        $result = \Indonesia::findProvince($selectedProvinceId, ['kokab', 'kecamatan.desa']);

        $this->assertNotEmpty($result->kokab);
        $this->assertNotEmpty($result->kecamatan);
        $this->assertNotEmpty($result->kecamatan[0]->desa);

        $result = \Indonesia::findProvince($selectedProvinceId, ['kokab.kecamatan']);

        $this->assertNotEmpty($result->kokab[0]->kecamatan);

        $result = \Indonesia::findProvince($selectedProvinceId, ['kokab.kecamatan.desa']);

        $this->assertNotEmpty($result->kokab[0]->kecamatan[0]->desa);
    }

    public function checkCities()
    {
        $results = \Indonesia::allCities();

        $this->assertNotEmpty($results);

        $results = \Indonesia::paginateCities();

        $this->assertEquals(count($results), 15);

        // array $with : provinsi, kecamatan, desa, kecamatan.desa

        $selectedCityId = $results[0]->id;

        $result = \Indonesia::findCity($selectedCityId);

        $this->assertEquals($result->id, $selectedCityId);

        $result = \Indonesia::findCity($selectedCityId, ['provinsi']);

        $this->assertNotEmpty($result->provinsi);

        $result = \Indonesia::findCity($selectedCityId, ['kecamatan']);

        $this->assertNotEmpty($result->kecamatan);

        $result = \Indonesia::findCity($selectedCityId, ['desa']);

        $this->assertNotEmpty($result->desa);

        $result = \Indonesia::findCity($selectedCityId, ['kecamatan.desa']);

        $this->assertNotEmpty($result->kecamatan);
        $this->assertNotEmpty($result->kecamatan[0]->desa);
    }

    public function checkDistricts()
    {
        $results = \Indonesia::allDistricts();

        $this->assertNotEmpty($results);

        $results = \Indonesia::paginateDistricts();

        $this->assertEquals(count($results), 15);

        // array $with : provinsi, kokab, kokab.provinsi, desa

        $selectedDistrictId = $results[0]->id;

        $result = \Indonesia::findDistrict($selectedDistrictId);

        $this->assertEquals($result->id, $selectedDistrictId);

        $result = \Indonesia::findDistrict($selectedDistrictId, ['provinsi']);

        $this->assertNotEmpty($result->provinsi);

        $result = \Indonesia::findDistrict($selectedDistrictId, ['kokab']);

        $this->assertNotEmpty($result->kokab);

        $result = \Indonesia::findDistrict($selectedDistrictId, ['kokab.provinsi']);

        $this->assertNotEmpty($result->kokab);
        $this->assertNotEmpty($result->kokab->provinsi);

        $result = \Indonesia::findDistrict($selectedDistrictId, ['desa']);

        $this->assertNotEmpty($result->desa);
    }

    public function checkVillages()
    {
        $results = \Indonesia::allVillages();

        $this->assertNotEmpty($results);

        $results = \Indonesia::paginateVillages();

        $this->assertEquals(count($results), 15);

        // array $with : provinsi, kokab, kecamatan, kecamatan.kokab, kecamatan.kokab.provinsi

        $selectedVillageId = $results[0]->id;

        $result = \Indonesia::findVillage($selectedVillageId);

        $this->assertEquals($result->id, $selectedVillageId);

        $result = \Indonesia::findVillage($selectedVillageId, ['provinsi']);

        $this->assertNotEmpty($result->provinsi);

        $result = \Indonesia::findVillage($selectedVillageId, ['kokab']);

        $this->assertNotEmpty($result->kokab);

        $result = \Indonesia::findVillage($selectedVillageId, ['kecamatan.kokab']);

        $this->assertNotEmpty($result->kecamatan);
        $this->assertNotEmpty($result->kecamatan->kokab);

        $result = \Indonesia::findVillage($selectedVillageId, ['kecamatan.kokab.provinsi']);

        $this->assertNotEmpty($result->kecamatan);
        $this->assertNotEmpty($result->kecamatan->kokab);
        $this->assertNotEmpty($result->kecamatan->kokab->provinsi);
    }

    public function search()
    {
        $results = \Indonesia::search('YOGYAKARTA')->all();

        $this->assertNotEmpty($results);
    }
}
