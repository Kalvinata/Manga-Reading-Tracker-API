<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('manga', function (Blueprint $table) {

            $table->increments('manga_id');

            $table->unsignedInteger('genre_id');

            $table->string('manga_code', 10);

            $table->string('manga_title');

            $table->string('author');

            $table->enum('status', [
                'Ongoing',
                'Completed',
                'Hiatus'
            ])->default('Ongoing');

            $table->timestamps();

            $table->softDeletes();

            $table->foreign('genre_id')
                ->references('genre_id')
                ->on('genre')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manga');
    }
};