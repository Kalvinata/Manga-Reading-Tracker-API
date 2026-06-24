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
        Schema::create('reading_list', function (Blueprint $table) {

            $table->increments('reading_list_id');

            $table->unsignedInteger('manga_id');

            $table->unsignedBigInteger('user_id')->nullable();

            $table->enum('reading_status', [
                'Plan To Read',
                'Reading',
                'Completed',
                'Dropped'
            ])->default('Plan To Read');

            $table->integer('chapter_read')->default(0);

            $table->integer('rating')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->softDeletes();

            $table->foreign('manga_id')
                ->references('manga_id')
                ->on('manga')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reading_list');
    }
};