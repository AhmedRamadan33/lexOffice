<x-guest-layout :title="__('app.actions.login')">
    <div class="auth-wrapper p-3">
        <div class="card auth-card shadow-lg">
            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <img src="{{ asset('logo.png') }}" alt="{{ __('app.app_name') }}" class="brand-logo-lg">
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('app.labels.email') }}</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('app.labels.password') }}</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="remember" id="remember" class="form-check-input">
                        <label for="remember" class="form-check-label">{{ app()->getLocale() === 'ar' ? 'تذكرني' : 'Remember me' }}</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">{{ __('app.actions.login') }}</button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
