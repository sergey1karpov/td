<?php

use App\Enums\RoleEnum;
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
        Schema::create('lists_users', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('list_id')->nullable();
            $table->foreign('list_id')->references('id')->on('lists')->onDelete('cascade');

            $table->enum('role', [
                RoleEnum::Admin->value,
                RoleEnum::Moderator->value,
                RoleEnum::Reader->value,
                RoleEnum::Close->value,
            ])->default(RoleEnum::Admin->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_user');
    }
};
