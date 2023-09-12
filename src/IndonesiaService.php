<?php

namespace Itik\Indonesia;

class IndonesiaService
{
    protected $search;

    public function search($location)
    {
        $this->search = strtoupper($location);

        return $this;
    }

    public function all()
    {
        $result = collect([]);

        if ($this->search) {
            $provinces = Models\Provinsi::search($this->search)->get();
            $cities = Models\Kokab::search($this->search)->get();
            $districts = Models\Kecamatan::search($this->search)->get();
            $villages = Models\Desa::search($this->search)->get();
            $result->push($provinces);
            $result->push($cities);
            $result->push($districts);
            $result->push($villages);
        }

        return $result->collapse();
    }

    public function allProvinces()
    {
        if ($this->search) {
            return Models\Provinsi::search($this->search)->get();
        }

        return Models\Provinsi::all();
    }

    public function paginateProvinces($numRows = 15)
    {
        if ($this->search) {
            return Models\Provinsi::search($this->search)->paginate();
        }

        return Models\Provinsi::paginate($numRows);
    }

    public function allCities()
    {
        if ($this->search) {
            return Models\Kokab::search($this->search)->get();
        }

        return Models\Kokab::all();
    }

    public function paginateCities($numRows = 15)
    {
        if ($this->search) {
            return Models\Kokab::search($this->search)->paginate();
        }

        return Models\Kokab::paginate($numRows);
    }

    public function allDistricts()
    {
        if ($this->search) {
            return Models\Kecamatan::search($this->search)->get();
        }

        return Models\Kecamatan::all();
    }

    public function paginateDistricts($numRows = 15)
    {
        if ($this->search) {
            return Models\Kecamatan::search($this->search)->paginate();
        }

        return Models\Kecamatan::paginate($numRows);
    }

    public function allVillages()
    {
        if ($this->search) {
            return Models\Desa::search($this->search)->get();
        }

        return Models\Desa::all();
    }

    public function paginateVillages($numRows = 15)
    {
        if ($this->search) {
            return Models\Desa::search($this->search)->paginate();
        }

        return Models\Desa::paginate($numRows);
    }

    public function findProvince($provinceId, $with = null)
    {
        $with = (array) $with;

        if ($with) {
            $withVillages = array_search('desa', $with);

            if ($withVillages !== false) {
                unset($with[$withVillages]);

                $province = Models\Provinsi::with($with)->find($provinceId);

                $province = $this->loadRelation($province, 'kokab.kecamatan.desa');
            } else {
                $province = Models\Provinsi::with($with)->find($provinceId);
            }

            return $province;
        }

        return Models\Provinsi::find($provinceId);
    }

    public function findCity($cityId, $with = null)
    {
        $with = (array) $with;

        if ($with) {
            return Models\Kokab::with($with)->find($cityId);
        }

        return Models\Kokab::find($cityId);
    }

    public function findDistrict($districtId, $with = null)
    {
        $with = (array) $with;

        if ($with) {
            $withProvince = array_search('provinsi', $with);

            if ($withProvince !== false) {
                unset($with[$withProvince]);

                $district = Models\Kecamatan::with($with)->find($districtId);

                $district = $this->loadRelation($district, 'kokab.provinsi', true);
            } else {
                $district = Models\Kecamatan::with($with)->find($districtId);
            }

            return $district;
        }

        return Models\Kecamatan::find($districtId);
    }

    public function findVillage($villageId, $with = null)
    {
        $with = (array) $with;

        if ($with) {
            $withCity = array_search('kokab', $with);
            $withProvince = array_search('provinsi', $with);

            if ($withCity !== false && $withProvince !== false) {
                unset($with[$withCity]);
                unset($with[$withProvince]);

                $village = Models\Desa::with($with)->find($villageId);

                $village = $this->loadRelation($village, 'kecamatan.kokab', true);

                $village = $this->loadRelation($village, 'kecamatan.kokab.provinsi', true);
            } elseif ($withCity !== false) {
                unset($with[$withCity]);

                $village = Models\Desa::with($with)->find($villageId);

                $village = $this->loadRelation($village, 'kecamatan.kokab', true);
            } elseif ($withProvince !== false) {
                unset($with[$withProvince]);

                $village = Models\Desa::with($with)->find($villageId);

                $village = $this->loadRelation($village, 'kecamatan.kokab.provinsi', true);
            } else {
                $village = Models\Desa::with($with)->find($villageId);
            }

            return $village;
        }

        return Models\Desa::find($villageId);
    }

    private function loadRelation($object, $relation, $belongsTo = false)
    {
        $exploded = explode('.', $relation);
        $targetRelationName = end($exploded);

        // We need to clone it first because $object->load() below will call related relation.
        // I don't know why
        $newObject = clone $object;

        // https://softonsofa.com/laravel-querying-any-level-far-relations-with-simple-trick/
        // because Eloquent hasManyThrough cannot get through more than one deep relationship
        $object->load([$relation => function ($q) use (&$createdValue, $belongsTo) {
            if ($belongsTo) {
                $createdValue = $q->first();
            } else {
                $createdValue = $q->get()->unique();
            }
        }]);

        $newObject[$targetRelationName] = $createdValue;

        return $newObject;
    }
}
