<?php

namespace Itik\Indonesia\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Itik\Indonesia\Models\Desa;
use Itik\Indonesia\Models\Kecamatan;
use Itik\Indonesia\Models\Kokab;
use Itik\Indonesia\Models\Provinsi;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->reset();

        $this->call(ProvinsiSeeder::class);
        $this->call(KokabSeeder::class);
        $this->call(KecamatanSeeder::class);
        $this->call(DesaSeeder::class);
    }

    public function reset()
    {
        Schema::disableForeignKeyConstraints();

        Desa::truncate();
        Kecamatan::truncate();
        Kokab::truncate();
        Provinsi::truncate();

        Schema::disableForeignKeyConstraints();
    }
}
