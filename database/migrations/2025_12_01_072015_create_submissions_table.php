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
       Schema::create('submissions', function (Blueprint $table) {
      $table->id();
      $table->foreignId('assignment_id')->constrained()->cascadeOnDelete();
      $table->foreignId('enrollment_id')->constrained()->cascadeOnDelete();
      $table->string('file_path');
      $table->datetime('submitted_at');
      $table->decimal('score',5,2)->nullable();
      $table->timestamps();
      $table->unique(['assignment_id','enrollment_id']);
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
