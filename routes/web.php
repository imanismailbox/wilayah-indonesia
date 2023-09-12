<?php

$router->group(
    [
        'namespace' => '\Itik\Indonesia\Http\Controllers',
        'prefix' => config('itik.indonesia.route.prefix'),
        'as' => 'indonesia::',
        'middleware' => config('itik.indonesia.route.middleware'),
    ],
    function ($router) {
        $router->resource('provinsi', 'ProvinsiController');
        $router->resource('kabupaten', 'KabupatenController');
        $router->resource('kecamatan', 'KecamatanController');
        $router->resource('kelurahan', 'KelurahanController');
    }
);
