# ITIK INDONESIA

Package Laravel yang berisi data Provinsi, Kabupaten/Kota, dan Kecamatan/Desa di seluruh Indonesia.
Merupakan fork dari [laravolt/indonesia](https://github.com/laravolt/indonesia) yang telah dimodifikasi untuk keperluan API.
Data wilayah diambil dari [edwardsamuel/Wilayah-Administratif-Indonesia](https://github.com/edwardsamuel/Wilayah-Administratif-Indonesia).

## Instalasi

### Install Package Via Composer
```
composer require itik/indonesia
```

### Daftarkan Service Provider dan Facade (Untuk Laravel < 5.5)

Mulai versi 5.5 ke atas, Laravel sudah support fitur auto discover sehingga tidak perlu lagi mendaftarkan Service Provider dan Facade secara manual.

Tambahkan Service Provider dan Facade pada `config.app`

```php
'providers' => [

    Itik\Indonesia\ServiceProvider::class

]
```

```php
'aliases' => [

    'Indonesia' => Itik\Indonesia\Facade::class

]
```

### Daftarkan Service Provider dan Facade untuk Lumen
Dalam file `bootstrap/app.php`, uncomment baris berikut
```php
$app->withFacades();
$app->withEloquent();
```

Dalam file `bootstrap/app.php`, daftarkan service provider dan alias/facade dengan menambahkan kode berokut.
```php
$app->register(Itik\Indonesia\ServiceProvider::class);


// class aliases
class_alias(Itik\Indonesia\Facade::class, 'Indonesia');
```

Untuk mengatur prefix tabel, buat file `config/wilayah-indonesia.php`, lalu copy kode berikut (ganti `indonesia_` dengan nilai prefix tabel yang diinginkan),
```php
<?php

return [
    'indonesia' => [
        'table_prefix' => 'id_',
    ],
];
```
Lalu daftarkan konfigurasi dalam `bootstrap/app.php` dengan menambahkan kode berikut.
```php
$app->configure('wilayah-indonesia');
```

Untuk selanjutnya, konfigurasi bisa dipanggil dengan cara `config('wilayah-indonesia.table_prefix')`.

### Publish Migration (Hanya Untuk Laravel/Lumen 5.2)

Jika Anda menggunakan Laravel/Lumen versi 5.3 ke atas, abaikan langkah di bawah ini.
Untuk Laravel:
```php
php artisan vendor:publish --provider="Itik\Indonesia\ServiceProvider"
```
Untuk Lumen, file migrations harus di-copy manual dari direktori `vendor/itik/indonesia/database/migrations` atau [Migrations](database/migrations/)

### Jalankan Migration
```php
php artisan migrate
```

### Jalankan Seeder Untuk Mengisi Data Wilayah
```php
php artisan itik:indonesia:seed
```

### Untuk menambahkan seedernya ke file `DatabaseSeeder.php` ikuti contoh berikut:
```php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Itik\Indonesia\Models\Desa;
use Itik\Indonesia\Models\Kecamatan;
use Itik\Indonesia\Models\Kokab;
use Itik\Indonesia\Models\Provinsi;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            $this->call(ProvinsiSeeder::class);
            $this->call(KokabSeeder::class);
            $this->call(KecamatanSeeder::class);
            $this->call(DesaSeeder::class);
        ]);
    }
}

```

## Penggunaan

```php
\Indonesia::allProvinces()
\Indonesia::paginateProvinces($numRows = 15)
\Indonesia::allCities()
\Indonesia::paginateCities($numRows = 15)
\Indonesia::allDistricts()
\Indonesia::paginateDistricts($numRows = 15)
\Indonesia::allVillages()
\Indonesia::paginateVillages($numRows = 15)
```

---

```php
\Indonesia::findProvince($kode, $with = null)
// array $with : ['kokab', 'kecamatan', 'desa', 'kokab.kecamatan', 'kokab.kecamatan.desa', 'kecamatan.desa']

\Indonesia::findCity($kode, $with = null)
// array $with : ['provinsi', 'kecamatan', 'desa', 'kecamatan.desa']

Indonesia::findDistrict($kode, $with = null)
// array $with : ['provinsi', 'kokab', 'kokab.provinsi', 'desa']

\Indonesia::findVillage($kode, $with = null)
// array $with : ['provinsi', 'kokab', 'kecamatan', 'kecamatan.kokab', 'kecamatan.kokab.provinsi']
```

#### Examples

```php
Indonesia::findProvince(11, ['kokab']);

/*
Will return
Provinsi Object {
    'kode' => 11,
    'nama' => 'ACEH',
    'kokab' => Kokab Collections {
        Kokab Object,
        Kokab Object,
        Kokab Object,
        ...
    }
}
*/

Indonesia::findProvince(11, ['kokab', 'kecamatan.desa']);

/*
Will return
Provinsi Object {
    'kode' => 11,
    'nama' => 'ACEH',
    'kokab' => Kokab Collections {
        Kokab Object,
        Kokab Object,
        Kokab Object,
        ...
    },
    'kecamatan' => Kecamatan Collections {
        Kecamatan Object {
            'kode' => 1101010
            'kode_kokab' => '1101'
            'nama' => 'TEUPAH SELATAN'
            'kode_provinsi' => '11'
            'desa' => Desa Colletions {
                Desa Object,
                Desa Object,
                Desa Object,
                ...
            }
        },
        ...
    }
}
*/
```

---

```php
\Indonesia::search('yogyakarta')->all()
\Indonesia::search('yogyakarta')->allProvinces()
\Indonesia::search('yogyakarta')->paginateProvinces()
\Indonesia::search('yogyakarta')->allCities()
\Indonesia::search('yogyakarta')->paginateCities()
\Indonesia::search('yogyakarta')->allDistricts()
\Indonesia::search('yogyakarta')->paginateDistricts()
\Indonesia::search('yogyakarta')->allVillages()
\Indonesia::search('yogyakarta')->paginateVillages()
```

---

# Testing

Run

```
vendor/bin/phpunit tests
```
