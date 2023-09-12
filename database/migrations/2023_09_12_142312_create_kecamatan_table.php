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
        Schema::create(config('itik.indonesia.table_prefix') . 'kecamatan', function (Blueprint $table) {
            // $table->bigIncrements('id');
            $table->char('kode', 7)->unique()->primary();
            $table->char('kode_kokab', 4);
            $table->string('nama', 255);
            $table->timestamps();

            $table->foreign('kode_kokab')
                ->references('kode')
                ->on(config('itik.indonesia.table_prefix') . 'kokab')
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
        Schema::drop(config('itik.indonesia.table_prefix') . 'kecamatan');
    }
}
