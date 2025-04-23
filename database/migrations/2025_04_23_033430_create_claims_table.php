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
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('policy_number');
            $table->string('type'); 
            $table->date('incident_date');
            $table->string('incident_location');
            $table->text('description');
            $table->decimal('estimated_loss', 12, 2)->nullable();
            $table->string('police_report_number')->nullable();
            $table->string('witnesses')->nullable();
            $table->string('status')->default('pending');
            $table->json('ai_feedback')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};
