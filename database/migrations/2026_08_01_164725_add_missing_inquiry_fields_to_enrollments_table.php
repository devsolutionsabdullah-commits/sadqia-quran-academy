<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->string('student_name')->nullable()->after('course_id');
            $table->string('parent_name')->nullable()->after('student_name');
            $table->unsignedTinyInteger('age')->nullable()->after('parent_name');
            $table->string('country')->nullable()->after('age');
            $table->string('timezone')->nullable()->after('country');
            $table->string('preferred_timing')->nullable()->after('timezone');
            $table->string('whatsapp_number')->nullable()->after('preferred_timing');
            $table->text('message')->nullable()->after('whatsapp_number');
        });
    }

    public function down(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropColumn(['student_name', 'parent_name', 'age', 'country', 'timezone', 'preferred_timing', 'whatsapp_number', 'message']);
        });
    }
};