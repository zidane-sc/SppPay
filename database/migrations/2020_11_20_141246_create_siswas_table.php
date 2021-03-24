<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('avatar')->nullable();
            $table->string('nis')->unique();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->bigInteger('no_telp');
            $table->string('alamat');
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->string("nama_ayah");
            $table->string("pekerjaan_ayah");
            $table->string("nama_ibu");
            $table->string("pekerjaan_ibu");
            $table->bigInteger("kelas_id")->unsigned();
            $table->timestamps();

            $table->foreign("kelas_id")->references('id')->on('kelas')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswas');
    }
}
