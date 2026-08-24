<?php

namespace App\Repositories\Contracts;

use App\Models\SiteSetting;

interface SiteSettingRepositoryInterface
{
    public function current(): SiteSetting;

    public function update(SiteSetting $setting, array $data): SiteSetting;
}
