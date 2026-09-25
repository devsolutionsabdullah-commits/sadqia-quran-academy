<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->string('current_lesson')->nullable()->after('status');
            $table->unsignedTinyInteger('progress_percentage')->default(0)->after('current_lesson');
        });
    }

    public function down(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropColumn(['current_lesson', 'progress_percentage']);
        });
    }
};