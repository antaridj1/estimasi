<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('masyarakats_id');
            $table->string('gedungs_id');
            $table->integer('luas_tanah');
            $table->integer('luas_bangunan');
            $table->integer('total_biaya');
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
        Schema::dropIfExists('estimasi');
    }
}
