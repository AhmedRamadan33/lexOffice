<x-portal-layout :title="__('app.portal.profile.title')">
    <section class="pub-section py-4">
        <div class="container" style="max-width:520px;">
            <h4 class="mb-4" style="color:var(--pub-navy);">{{ __('app.portal.profile.title') }}</h4>

            <div class="pub-detail-card">
                <h6><i class="bi bi-shield-lock text-warning"></i>{{ __('app.portal.profile.change_password') }}</h6>
                <form method="POST" action="{{ route('portal.profile.password') }}" class="pub-contact-form mt-3">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">{{ __('app.labels.current_password') }}</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('app.labels.new_password') }}</label>
                        <input type="password" name="password" class="form-control" required minlength="6">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('app.labels.confirm_password') }}</label>
                        <input type="password" name="password_confirmation" class="form-control" required minlength="6">
                    </div>
                    <button type="submit" class="pub-btn-gold">{{ __('app.actions.save') }}</button>
                </form>
            </div>
        </div>
    </section>
</x-portal-layout>
