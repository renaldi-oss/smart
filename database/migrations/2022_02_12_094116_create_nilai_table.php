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
            $table->unsignedBigInteger('alternatif_id');
            $table->unsignedBigInteger('kriteria_id');
            $table->unsignedBigInteger('parameter_id');
            $table->string('nilai');
            $table->timestamps();
            $table->foreign('alternatif_id')->references('id')->on('alternatif')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('kriteria_id')->references('id')->on('kriteria')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('parameter_id')->references('id')->on('parameter')->cascadeOnDelete()->cascadeOnUpdate();
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
