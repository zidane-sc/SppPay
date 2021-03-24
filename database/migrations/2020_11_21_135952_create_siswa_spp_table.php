<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaSppTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa_spp', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('siswa_id')->unsigned();
            $table->bigInteger('spp_id')->unsigned();
            $table->bigInteger("user_id")->unsigned();
            $table->string('no_transaksi')->unique();
            $table->integer('nominal');
            $table->integer('bayar');
            $table->integer('kembalian');
            $table->timestamp('waktu_pembayaran');
            $table->timestamps();

            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');;
            $table->foreign('spp_id')->references('id')->on('spps')->onDelete('cascade');;
            $table->foreign("user_id")->references('id')->on('users')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('siswa_spp', function(Blueprint $table){
            $table->dropForeign(['siswa_id']);
            $table->dropForeign(['spp_id']);
        });
        Schema::dropIfExists('siswa_spp');
    }
}
