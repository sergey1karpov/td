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
        Schema::table('list_elements', function($table) {
            $table->dropColumn('image');
        });

        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->text('image')->nullable();
            $table->text('thumbnail');

            $table->unsignedBigInteger('list_element_id')->nullable();
            $table->foreign('list_element_id')->references('id')->on('list_elements')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image');
    }
};
