<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('regis_semis', function (Blueprint $table) {
            $table->id(); // Primary increment, sesuai TypeORM @PrimaryGeneratedColumn()

            $table->string('nama_seminar');      // string
            $table->string('penyelenggara');     // string
            $table->date('tanggal_seminar');     // date format
            $table->string('lokasi');            // string

            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('regis_semis');
    }
};
