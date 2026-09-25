<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->string('gender')->nullable()->after('age');
            $table->string('quran_experience')->nullable()->after('preferred_timing');
            $table->foreignId('preferred_teacher_id')->nullable()->constrained('users')->nullOnDelete()->after('quran_experience');
        });
    }

    public function down(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropForeign(['preferred_teacher_id']);
            $table->dropColumn(['gender', 'quran_experience', 'preferred_teacher_id']);
        });
    }
};