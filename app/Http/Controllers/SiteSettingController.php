<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteSetting\UpdateSiteSettingRequest;
use App\Services\SiteSettingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    public function __construct(protected SiteSettingService $settings)
    {
    }

    public function edit(): View
    {
        $setting = $this->settings->edit();

        return view('site-settings.edit', compact('setting'));
    }

    public function update(UpdateSiteSettingRequest $request): RedirectResponse
    {
        $this->settings->update($request->validated(), $request);

        return redirect()->route('site-settings.edit')->with('success', __('app.messages.updated'));
    }
}
