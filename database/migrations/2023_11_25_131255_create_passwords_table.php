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
        Schema::create('passwords', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->string('value');
            $table->string('hash');
            $table->foreignId("creator_id")
                    ->nullable()
                    ->constrained(table: 'users')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();
            $table->foreignId("group_id")
                    ->constrained()
                    ->cascadeOnUpdate()
                    ->restrictOnDelete();
            $table->timestamps();
            $table->unique(['group_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passwords');
    }
};
