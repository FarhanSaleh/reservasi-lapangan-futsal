<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['transaction', 'revenue', 'usage']);
            $table->date('period_start');
            $table->date('period_end');
            $table->json('data')->nullable();
            $table->foreignId('generated_by')->constrained('users')->onDelete('cascade');
            $table->timestamp('generated_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
