<?php

namespace Badak\Indonesia\Seeds;

// use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinsiSeeder extends Seeder
{
    public function run()
    {
        $csv = new CsvtoArray;
        $file = __DIR__.'/../../resources/csv/provinsi.csv';
        $header = ['kode', 'nama'];
        $data = $csv->csv_to_array($file, $header);

        $collection = collect($data);
        foreach ($collection->chunk(50) as $chunk) {
            DB::table(config('wilayah-indonesia.table_prefix').'provinsi')->insertOrIgnore($chunk->toArray());
        }
    }
}
