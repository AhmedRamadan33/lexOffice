<?php

namespace App\Http\Requests\SiteSetting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiteSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'hero_title' => ['nullable', 'array'],
            'hero_title.ar' => ['nullable', 'string', 'max:255'],
            'hero_title.en' => ['nullable', 'string', 'max:255'],
            'hero_subtitle' => ['nullable', 'array'],
            'hero_subtitle.ar' => ['nullable', 'string'],
            'hero_subtitle.en' => ['nullable', 'string'],
            'hero_cta_primary_text' => ['nullable', 'array'],
            'hero_cta_primary_text.ar' => ['nullable', 'string', 'max:100'],
            'hero_cta_primary_text.en' => ['nullable', 'string', 'max:100'],
            'hero_cta_primary_url' => ['nullable', 'string', 'max:255'],
            'hero_cta_secondary_text' => ['nullable', 'array'],
            'hero_cta_secondary_text.ar' => ['nullable', 'string', 'max:100'],
            'hero_cta_secondary_text.en' => ['nullable', 'string', 'max:100'],
            'hero_cta_secondary_url' => ['nullable', 'string', 'max:255'],
            'hero_image' => ['nullable', 'image', 'max:4096'],

            'stat1_value' => ['nullable', 'string', 'max:50'],
            'stat1_label' => ['nullable', 'array'],
            'stat1_label.ar' => ['nullable', 'string', 'max:100'],
            'stat1_label.en' => ['nullable', 'string', 'max:100'],
            'stat2_value' => ['nullable', 'string', 'max:50'],
            'stat2_label' => ['nullable', 'array'],
            'stat2_label.ar' => ['nullable', 'string', 'max:100'],
            'stat2_label.en' => ['nullable', 'string', 'max:100'],
            'stat3_value' => ['nullable', 'string', 'max:50'],
            'stat3_label' => ['nullable', 'array'],
            'stat3_label.ar' => ['nullable', 'string', 'max:100'],
            'stat3_label.en' => ['nullable', 'string', 'max:100'],
            'stat4_value' => ['nullable', 'string', 'max:50'],
            'stat4_label' => ['nullable', 'array'],
            'stat4_label.ar' => ['nullable', 'string', 'max:100'],
            'stat4_label.en' => ['nullable', 'string', 'max:100'],

            'about_title' => ['nullable', 'array'],
            'about_title.ar' => ['nullable', 'string', 'max:255'],
            'about_title.en' => ['nullable', 'string', 'max:255'],
            'about_body' => ['nullable', 'array'],
            'about_body.ar' => ['nullable', 'string'],
            'about_body.en' => ['nullable', 'string'],
            'vision_text' => ['nullable', 'array'],
            'vision_text.ar' => ['nullable', 'string'],
            'vision_text.en' => ['nullable', 'string'],
            'mission_text' => ['nullable', 'array'],
            'mission_text.ar' => ['nullable', 'string'],
            'mission_text.en' => ['nullable', 'string'],
            'values_text' => ['nullable', 'array'],
            'values_text.ar' => ['nullable', 'string'],
            'values_text.en' => ['nullable', 'string'],
            'experience_text' => ['nullable', 'array'],
            'experience_text.ar' => ['nullable', 'string'],
            'experience_text.en' => ['nullable', 'string'],
            'about_image' => ['nullable', 'image', 'max:4096'],

            'contact_phone_primary' => ['nullable', 'string', 'max:50'],
            'contact_phone_secondary' => ['nullable', 'string', 'max:50'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_address' => ['nullable', 'array'],
            'contact_address.ar' => ['nullable', 'string'],
            'contact_address.en' => ['nullable', 'string'],
            'contact_working_hours' => ['nullable', 'array'],
            'contact_working_hours.ar' => ['nullable', 'string', 'max:255'],
            'contact_working_hours.en' => ['nullable', 'string', 'max:255'],
            'contact_map_embed_url' => ['nullable', 'string', 'max:2000'],
            'facebook_url' => ['nullable', 'string', 'max:255'],
            'twitter_url' => ['nullable', 'string', 'max:255'],
            'linkedin_url' => ['nullable', 'string', 'max:255'],
            'instagram_url' => ['nullable', 'string', 'max:255'],
            'whatsapp_url' => ['nullable', 'string', 'max:255'],

            'footer_about_text' => ['nullable', 'array'],
            'footer_about_text.ar' => ['nullable', 'string'],
            'footer_about_text.en' => ['nullable', 'string'],
            'footer_copyright' => ['nullable', 'array'],
            'footer_copyright.ar' => ['nullable', 'string', 'max:255'],
            'footer_copyright.en' => ['nullable', 'string', 'max:255'],
        ];
    }
}
