<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_alternatif');
            $table->unsignedBigInteger('id_kriteria');
            $table->unsignedBigInteger('id_parameter');
            $table->timestamps();

            $table->foreign('id_alternatif')->references('id')->on('alternatif')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('id_kriteria')->references('id')->on('kriteria')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('id_parameter')->references('id')->on('parameter')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai');
    }
}
