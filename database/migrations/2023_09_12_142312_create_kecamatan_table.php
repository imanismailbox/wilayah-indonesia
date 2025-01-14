<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKecamatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('wilayah-indonesia.table_prefix').'kecamatan', function (Blueprint $table) {
            $table->char('kode', 6)->unique()->primary();
            $table->char('kode_kokab', 4);
            $table->string('nama', 255);

            $table->foreign('kode_kokab')
                ->references('kode')
                ->on(config('wilayah-indonesia.table_prefix').'kokab')
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
        Schema::drop(config('wilayah-indonesia.table_prefix').'kecamatan');
    }
}
