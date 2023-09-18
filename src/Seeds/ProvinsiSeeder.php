<?php

namespace Itik\Indonesia\Seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProvinsiSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        $csv = new CsvtoArray();
        $file = __DIR__ . '/../../resources/csv/provinsi.csv';
        $header = ['kode', 'nama'];
        $data = $csv->csv_to_array($file, $header);
        // $data = array_map(function ($arr) use ($now) {
        //     return $arr + ['created_at' => $now, 'updated_at' => $now];
        // }, $data);

        $collection = collect($data);
        foreach ($collection->chunk(50) as $chunk) {
            DB::table(config('wilayah-indonesia.table_prefix') . 'provinsi')->insertOrIgnore($chunk->toArray());
        }
    }
}
