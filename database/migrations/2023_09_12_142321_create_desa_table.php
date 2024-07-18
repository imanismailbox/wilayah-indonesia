<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('wilayah-indonesia.table_prefix').'desa', function (Blueprint $table) {
            $table->char('kode', 10)->unique()->primary();
            $table->char('kode_kecamatan', 7);
            $table->string('nama', 255);

            $table->foreign('kode_kecamatan')
                ->references('kode')
                ->on(config('wilayah-indonesia.table_prefix').'kecamatan')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(config('wilayah-indonesia.table_prefix').'desa');
    }
}
