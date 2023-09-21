<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKokabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('wilayah-indonesia.table_prefix') . 'kokab', function (Blueprint $table) {
            $table->char('kode', 4)->unique()->primary();
            $table->char('kode_provinsi', 2);
            $table->string('nama', 255);

            $table->foreign('kode_provinsi')
                ->references('kode')
                ->on(config('wilayah-indonesia.table_prefix') . 'provinsi')
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
        Schema::drop(config('wilayah-indonesia.table_prefix') . 'kokab');
    }
}
