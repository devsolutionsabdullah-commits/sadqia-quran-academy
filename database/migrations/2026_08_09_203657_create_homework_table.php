<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('homework', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('due_date')->nullable();
            $table->string('attachment_path')->nullable(); // teacher's uploaded file (if any)
            $table->foreignId('assigned_by')->constrained('users')->onDelete('cascade');
            $table->string('submission_path')->nullable(); // student's submitted file
            $table->timestamp('submitted_at')->nullable();
            $table->enum('status', ['pending', 'submitted'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('homework');
    }
};