<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('teacher_profiles', function (Blueprint $table) {
            $table->string('photo_path')->nullable()->after('bio');
            $table->string('languages')->nullable()->after('photo_path');
            $table->string('specialization')->nullable()->after('languages');
        });
    }

    public function down(): void
    {
        Schema::table('teacher_profiles', function (Blueprint $table) {
            $table->dropColumn(['photo_path', 'languages', 'specialization']);
        });
    }
};