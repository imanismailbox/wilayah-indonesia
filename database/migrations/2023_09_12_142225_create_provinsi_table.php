<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvinsiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('karomap.indonesia.table_prefix') . 'provinsi', function (Blueprint $table) {
            // $table->bigIncrements('id');
            $table->char('kode', 2)->unique()->primary();
            $table->string('nama', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(config('karomap.indonesia.table_prefix') . 'provinsi');
    }
}
