<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('m_todos', function (Blueprint $table) {
            // Primary ID (UUID)
            $table->uuid('id')->primary();

            // User ID bukan primary key (menyesuaikan Sequelize)
            $table->uuid('user_id');

            // Field sesuai Sequelize
            $table->string('title');
            $table->text('description')->nullable();
            $table->boolean('is_done')->default(false);

            // Tambahan field "cover" → Sequelize punya field ini
            $table->string('cover')->nullable();

            // Timestamps
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_todos');
    }
};
