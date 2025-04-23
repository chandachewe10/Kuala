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
        Schema::create('open_a_i_configs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('base_uri')->nullable();
            $table->string('endpoint')->nullable();
            $table->string('token')->nullable();
            $table->string('prompt')->nullable();
            $table->enum('status', ['ACTIVE', 'DISABLED'])->default('DISABLED');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('open_a_i_configs');
    }
};
