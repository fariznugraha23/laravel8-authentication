<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_area');
            $table->integer('area_rb');
            $table->string('penilaian', 1000);
            $table->string('a',500);
            $table->string('b',500);
            $table->string('c',500);
            $table->char('nilai',11);
            $table->integer('id_kriteria');
            $table->integer('bobot');
            $table->integer('skor');
            $table->string('panduan_eviden',1000);
            $table->text('catatan_eviden');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apms');
    }
}
