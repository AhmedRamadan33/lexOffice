<?php

namespace App\Services;

use App\Models\SiteSetting;
use App\Repositories\Contracts\SiteSettingRepositoryInterface;
use Illuminate\Http\Request;

class SiteSettingService
{
    public function __construct(protected SiteSettingRepositoryInterface $settings)
    {
    }

    public function edit(): SiteSetting
    {
        return $this->settings->current();
    }

    public function update(array $data, Request $request): SiteSetting
    {
        $setting = $this->settings->update($this->settings->current(), $data);

        if ($request->hasFile('hero_image')) {
            $setting->addMediaFromRequest('hero_image')->toMediaCollection('hero_image');
        }

        if ($request->hasFile('about_image')) {
            $setting->addMediaFromRequest('about_image')->toMediaCollection('about_image');
        }

        return $setting;
    }
}
