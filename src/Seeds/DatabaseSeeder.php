<?php

namespace Badak\Indonesia\Seeds;

use Badak\Indonesia\Models\Desa;
use Badak\Indonesia\Models\Kecamatan;
use Badak\Indonesia\Models\Kokab;
use Badak\Indonesia\Models\Provinsi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

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
