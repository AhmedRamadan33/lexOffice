<x-app-layout :title="__('app.site_settings.title')">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">{{ __('app.site_settings.title') }}</h4>
        <a href="{{ route('public.home') }}" target="_blank" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-box-arrow-up-right me-1"></i>{{ __('app.public.nav.home') }}
        </a>
    </div>

    <form method="POST" action="{{ route('site-settings.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card mb-3">
            <div class="card-header fw-semibold">{{ __('app.site_settings.hero_section') }}</div>
            <div class="card-body">
                @if ($setting->hasMedia('hero_image'))
                    <div class="mb-3">
                        <img src="{{ $setting->getFirstMediaUrl('hero_image') }}" class="rounded" style="width:220px;height:120px;object-fit:cover;">
                    </div>
                @endif
                <div class="mb-3">
                    <label class="form-label">{{ __('app.site_settings.hero_image') }}</label>
                    <input type="file" name="hero_image" class="form-control" accept="image/*">
                </div>

                <x-language-tabs id="hero-lang">
                    <x-slot:ar>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.site_settings.hero_title') }} ({{ __('app.labels.arabic') }})</label>
                            <input type="text" name="hero_title[ar]" value="{{ old('hero_title.ar', $setting->getTranslationWithoutFallback('hero_title', 'ar')) }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.site_settings.hero_subtitle') }} ({{ __('app.labels.arabic') }})</label>
                            <textarea name="hero_subtitle[ar]" class="form-control" rows="2">{{ old('hero_subtitle.ar', $setting->getTranslationWithoutFallback('hero_subtitle', 'ar')) }}</textarea>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">{{ __('app.site_settings.hero_cta_primary_text') }} ({{ __('app.labels.arabic') }})</label>
                                <input type="text" name="hero_cta_primary_text[ar]" value="{{ old('hero_cta_primary_text.ar', $setting->getTranslationWithoutFallback('hero_cta_primary_text', 'ar')) }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">{{ __('app.site_settings.hero_cta_secondary_text') }} ({{ __('app.labels.arabic') }})</label>
                                <input type="text" name="hero_cta_secondary_text[ar]" value="{{ old('hero_cta_secondary_text.ar', $setting->getTranslationWithoutFallback('hero_cta_secondary_text', 'ar')) }}" class="form-control">
                            </div>
                        </div>
                    </x-slot:ar>
                    <x-slot:en>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.site_settings.hero_title') }} ({{ __('app.labels.english') }})</label>
                            <input type="text" name="hero_title[en]" value="{{ old('hero_title.en', $setting->getTranslationWithoutFallback('hero_title', 'en')) }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.site_settings.hero_subtitle') }} ({{ __('app.labels.english') }})</label>
                            <textarea name="hero_subtitle[en]" class="form-control" rows="2">{{ old('hero_subtitle.en', $setting->getTranslationWithoutFallback('hero_subtitle', 'en')) }}</textarea>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">{{ __('app.site_settings.hero_cta_primary_text') }} ({{ __('app.labels.english') }})</label>
                                <input type="text" name="hero_cta_primary_text[en]" value="{{ old('hero_cta_primary_text.en', $setting->getTranslationWithoutFallback('hero_cta_primary_text', 'en')) }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">{{ __('app.site_settings.hero_cta_secondary_text') }} ({{ __('app.labels.english') }})</label>
                                <input type="text" name="hero_cta_secondary_text[en]" value="{{ old('hero_cta_secondary_text.en', $setting->getTranslationWithoutFallback('hero_cta_secondary_text', 'en')) }}" class="form-control">
                            </div>
                        </div>
                    </x-slot:en>
                </x-language-tabs>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.site_settings.hero_cta_primary_url') }}</label>
                        <input type="text" name="hero_cta_primary_url" value="{{ old('hero_cta_primary_url', $setting->hero_cta_primary_url) }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.site_settings.hero_cta_secondary_url') }}</label>
                        <input type="text" name="hero_cta_secondary_url" value="{{ old('hero_cta_secondary_url', $setting->hero_cta_secondary_url) }}" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header fw-semibold">{{ __('app.site_settings.stats_section') }}</div>
            <div class="card-body">
                <div class="row g-3">
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="col-md-3">
                            <label class="form-label">{{ __('app.site_settings.stat_value') }} {{ $i }}</label>
                            <input type="text" name="stat{{ $i }}_value" value="{{ old('stat'.$i.'_value', $setting->{'stat'.$i.'_value'}) }}" class="form-control mb-2" placeholder="6+">
                            <input type="text" name="stat{{ $i }}_label[ar]" value="{{ old('stat'.$i.'_label.ar', $setting->getTranslationWithoutFallback('stat'.$i.'_label', 'ar')) }}" class="form-control mb-2" placeholder="{{ __('app.site_settings.stat_label') }} ({{ __('app.labels.arabic') }})">
                            <input type="text" name="stat{{ $i }}_label[en]" value="{{ old('stat'.$i.'_label.en', $setting->getTranslationWithoutFallback('stat'.$i.'_label', 'en')) }}" class="form-control" placeholder="{{ __('app.site_settings.stat_label') }} ({{ __('app.labels.english') }})">
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header fw-semibold">{{ __('app.site_settings.about_section') }}</div>
            <div class="card-body">
                @if ($setting->hasMedia('about_image'))
                    <div class="mb-3">
                        <img src="{{ $setting->getFirstMediaUrl('about_image') }}" class="rounded" style="width:220px;height:120px;object-fit:cover;">
                    </div>
                @endif
                <div class="mb-3">
                    <label class="form-label">{{ __('app.site_settings.about_image') }}</label>
                    <input type="file" name="about_image" class="form-control" accept="image/*">
                </div>

                <x-language-tabs id="about-lang">
                    <x-slot:ar>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.site_settings.about_title') }} ({{ __('app.labels.arabic') }})</label>
                            <input type="text" name="about_title[ar]" value="{{ old('about_title.ar', $setting->getTranslationWithoutFallback('about_title', 'ar')) }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.site_settings.about_body') }} ({{ __('app.labels.arabic') }})</label>
                            <textarea name="about_body[ar]" class="form-control" rows="4">{{ old('about_body.ar', $setting->getTranslationWithoutFallback('about_body', 'ar')) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.site_settings.vision_text') }} ({{ __('app.labels.arabic') }})</label>
                            <textarea name="vision_text[ar]" class="form-control" rows="2">{{ old('vision_text.ar', $setting->getTranslationWithoutFallback('vision_text', 'ar')) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.site_settings.mission_text') }} ({{ __('app.labels.arabic') }})</label>
                            <textarea name="mission_text[ar]" class="form-control" rows="2">{{ old('mission_text.ar', $setting->getTranslationWithoutFallback('mission_text', 'ar')) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.site_settings.values_text') }} ({{ __('app.labels.arabic') }})</label>
                            <textarea name="values_text[ar]" class="form-control" rows="2">{{ old('values_text.ar', $setting->getTranslationWithoutFallback('values_text', 'ar')) }}</textarea>
                        </div>
                        <div>
                            <label class="form-label">{{ __('app.site_settings.experience_text') }} ({{ __('app.labels.arabic') }})</label>
                            <textarea name="experience_text[ar]" class="form-control" rows="2">{{ old('experience_text.ar', $setting->getTranslationWithoutFallback('experience_text', 'ar')) }}</textarea>
                        </div>
                    </x-slot:ar>
                    <x-slot:en>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.site_settings.about_title') }} ({{ __('app.labels.english') }})</label>
                            <input type="text" name="about_title[en]" value="{{ old('about_title.en', $setting->getTranslationWithoutFallback('about_title', 'en')) }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.site_settings.about_body') }} ({{ __('app.labels.english') }})</label>
                            <textarea name="about_body[en]" class="form-control" rows="4">{{ old('about_body.en', $setting->getTranslationWithoutFallback('about_body', 'en')) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.site_settings.vision_text') }} ({{ __('app.labels.english') }})</label>
                            <textarea name="vision_text[en]" class="form-control" rows="2">{{ old('vision_text.en', $setting->getTranslationWithoutFallback('vision_text', 'en')) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.site_settings.mission_text') }} ({{ __('app.labels.english') }})</label>
                            <textarea name="mission_text[en]" class="form-control" rows="2">{{ old('mission_text.en', $setting->getTranslationWithoutFallback('mission_text', 'en')) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.site_settings.values_text') }} ({{ __('app.labels.english') }})</label>
                            <textarea name="values_text[en]" class="form-control" rows="2">{{ old('values_text.en', $setting->getTranslationWithoutFallback('values_text', 'en')) }}</textarea>
                        </div>
                        <div>
                            <label class="form-label">{{ __('app.site_settings.experience_text') }} ({{ __('app.labels.english') }})</label>
                            <textarea name="experience_text[en]" class="form-control" rows="2">{{ old('experience_text.en', $setting->getTranslationWithoutFallback('experience_text', 'en')) }}</textarea>
                        </div>
                    </x-slot:en>
                </x-language-tabs>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header fw-semibold">{{ __('app.site_settings.contact_section') }}</div>
            <div class="card-body">
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.site_settings.contact_phone_primary') }}</label>
                        <input type="text" name="contact_phone_primary" value="{{ old('contact_phone_primary', $setting->contact_phone_primary) }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.site_settings.contact_phone_secondary') }}</label>
                        <input type="text" name="contact_phone_secondary" value="{{ old('contact_phone_secondary', $setting->contact_phone_secondary) }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.site_settings.contact_email') }}</label>
                        <input type="email" name="contact_email" value="{{ old('contact_email', $setting->contact_email) }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.site_settings.contact_working_hours') }} ({{ __('app.labels.arabic') }})</label>
                        <input type="text" name="contact_working_hours[ar]" value="{{ old('contact_working_hours.ar', $setting->getTranslationWithoutFallback('contact_working_hours', 'ar')) }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.site_settings.contact_working_hours') }} ({{ __('app.labels.english') }})</label>
                        <input type="text" name="contact_working_hours[en]" value="{{ old('contact_working_hours.en', $setting->getTranslationWithoutFallback('contact_working_hours', 'en')) }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.site_settings.contact_address') }} ({{ __('app.labels.arabic') }})</label>
                        <input type="text" name="contact_address[ar]" value="{{ old('contact_address.ar', $setting->getTranslationWithoutFallback('contact_address', 'ar')) }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.site_settings.contact_address') }} ({{ __('app.labels.english') }})</label>
                        <input type="text" name="contact_address[en]" value="{{ old('contact_address.en', $setting->getTranslationWithoutFallback('contact_address', 'en')) }}" class="form-control">
                    </div>
                    <div class="col-12">
                        <label class="form-label">{{ __('app.site_settings.contact_map_embed_url') }}</label>
                        <input type="text" name="contact_map_embed_url" value="{{ old('contact_map_embed_url', $setting->contact_map_embed_url) }}" class="form-control" placeholder="https://www.google.com/maps/embed?...">
                    </div>
                </div>

                <h6 class="mt-4">{{ __('app.site_settings.social_section') }}</h6>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label"><i class="bi bi-facebook me-1"></i>Facebook</label>
                        <input type="text" name="facebook_url" value="{{ old('facebook_url', $setting->facebook_url) }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><i class="bi bi-twitter-x me-1"></i>Twitter / X</label>
                        <input type="text" name="twitter_url" value="{{ old('twitter_url', $setting->twitter_url) }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><i class="bi bi-linkedin me-1"></i>LinkedIn</label>
                        <input type="text" name="linkedin_url" value="{{ old('linkedin_url', $setting->linkedin_url) }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><i class="bi bi-instagram me-1"></i>Instagram</label>
                        <input type="text" name="instagram_url" value="{{ old('instagram_url', $setting->instagram_url) }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><i class="bi bi-whatsapp me-1"></i>WhatsApp</label>
                        <input type="text" name="whatsapp_url" value="{{ old('whatsapp_url', $setting->whatsapp_url) }}" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header fw-semibold">{{ __('app.site_settings.footer_section') }}</div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.site_settings.footer_about_text') }} ({{ __('app.labels.arabic') }})</label>
                        <textarea name="footer_about_text[ar]" class="form-control" rows="2">{{ old('footer_about_text.ar', $setting->getTranslationWithoutFallback('footer_about_text', 'ar')) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.site_settings.footer_about_text') }} ({{ __('app.labels.english') }})</label>
                        <textarea name="footer_about_text[en]" class="form-control" rows="2">{{ old('footer_about_text.en', $setting->getTranslationWithoutFallback('footer_about_text', 'en')) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.site_settings.footer_copyright') }} ({{ __('app.labels.arabic') }})</label>
                        <input type="text" name="footer_copyright[ar]" value="{{ old('footer_copyright.ar', $setting->getTranslationWithoutFallback('footer_copyright', 'ar')) }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.site_settings.footer_copyright') }} ({{ __('app.labels.english') }})</label>
                        <input type="text" name="footer_copyright[en]" value="{{ old('footer_copyright.en', $setting->getTranslationWithoutFallback('footer_copyright', 'en')) }}" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
    </form>
</x-app-layout>
