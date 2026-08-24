<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class SiteSetting extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia, LogsActivity;

    protected $translatable = [
        'hero_title',
        'hero_subtitle',
        'hero_cta_primary_text',
        'hero_cta_secondary_text',
        'stat1_label',
        'stat2_label',
        'stat3_label',
        'stat4_label',
        'about_title',
        'about_body',
        'vision_text',
        'mission_text',
        'values_text',
        'experience_text',
        'contact_address',
        'contact_working_hours',
        'footer_about_text',
        'footer_copyright',
    ];

    protected $fillable = [
        'hero_title', 'hero_subtitle',
        'hero_cta_primary_text', 'hero_cta_primary_url',
        'hero_cta_secondary_text', 'hero_cta_secondary_url',
        'stat1_value', 'stat1_label',
        'stat2_value', 'stat2_label',
        'stat3_value', 'stat3_label',
        'stat4_value', 'stat4_label',
        'about_title', 'about_body', 'vision_text', 'mission_text', 'values_text', 'experience_text',
        'contact_phone_primary', 'contact_phone_secondary', 'contact_email', 'contact_address', 'contact_working_hours',
        'contact_map_embed_url',
        'facebook_url', 'twitter_url', 'linkedin_url', 'instagram_url', 'whatsapp_url',
        'footer_about_text', 'footer_copyright',
    ];

    public static function current(): self
    {
        return static::query()->firstOrCreate(['id' => 1]);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('hero_image')->singleFile();
        $this->addMediaCollection('about_image')->singleFile();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['contact_phone_primary', 'contact_email', 'hero_cta_primary_url'])
            ->logOnlyDirty()
            ->dontLogEmptyChanges();
    }
}
