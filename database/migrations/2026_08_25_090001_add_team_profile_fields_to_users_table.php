<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->json('title')->nullable()->after('name');
            $table->json('bio')->nullable();
            $table->json('specialties')->nullable();
            $table->json('education')->nullable();
            $table->json('experience')->nullable();
            $table->string('category')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_team_visible')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['title', 'bio', 'specialties', 'education', 'experience', 'category', 'sort_order', 'is_team_visible']);
        });
    }
};
