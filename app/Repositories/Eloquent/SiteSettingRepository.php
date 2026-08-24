<?php

namespace App\Repositories\Eloquent;

use App\Models\SiteSetting;
use App\Repositories\Contracts\SiteSettingRepositoryInterface;

class SiteSettingRepository implements SiteSettingRepositoryInterface
{
    public function current(): SiteSetting
    {
        return SiteSetting::current();
    }

    public function update(SiteSetting $setting, array $data): SiteSetting
    {
        $setting->update($data);

        return $setting;
    }
}
