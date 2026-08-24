<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();

            $table->json('hero_title')->nullable();
            $table->json('hero_subtitle')->nullable();
            $table->json('hero_cta_primary_text')->nullable();
            $table->string('hero_cta_primary_url')->nullable();
            $table->json('hero_cta_secondary_text')->nullable();
            $table->string('hero_cta_secondary_url')->nullable();

            $table->string('stat1_value')->nullable();
            $table->json('stat1_label')->nullable();
            $table->string('stat2_value')->nullable();
            $table->json('stat2_label')->nullable();
            $table->string('stat3_value')->nullable();
            $table->json('stat3_label')->nullable();
            $table->string('stat4_value')->nullable();
            $table->json('stat4_label')->nullable();

            $table->json('about_title')->nullable();
            $table->json('about_body')->nullable();
            $table->json('vision_text')->nullable();
            $table->json('mission_text')->nullable();
            $table->json('values_text')->nullable();
            $table->json('experience_text')->nullable();

            $table->string('contact_phone_primary')->nullable();
            $table->string('contact_phone_secondary')->nullable();
            $table->string('contact_email')->nullable();
            $table->json('contact_address')->nullable();
            $table->json('contact_working_hours')->nullable();
            $table->string('contact_map_embed_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('whatsapp_url')->nullable();

            $table->json('footer_about_text')->nullable();
            $table->json('footer_copyright')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
