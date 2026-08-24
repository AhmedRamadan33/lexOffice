<x-public-layout :title="__('app.public.lawyers.title')">
    <section class="pub-hero" style="padding: 3.5rem 0;">
        <div class="container text-center">
            <h1 style="font-size:2rem;">{{ __('app.public.lawyers.title') }}</h1>
            <p class="lead mx-auto">{{ __('app.public.lawyers.subtitle') }}</p>
        </div>
    </section>

    <section class="pub-section">
        <div class="container">
            @if ($categories->isNotEmpty())
                <div class="pub-filter-tabs">
                    <a href="{{ route('public.lawyers') }}" class="{{ ! $activeCategory ? 'active' : '' }}">{{ __('app.public.lawyers.all') }}</a>
                    @foreach ($categories as $category)
                        <a href="{{ route('public.lawyers', ['category' => $category]) }}" class="{{ $activeCategory === $category ? 'active' : '' }}">{{ $category }}</a>
                    @endforeach
                </div>
            @endif

            <div class="row g-4">
                @forelse ($teamMembers as $teamMember)
                    <div class="col-6 col-lg-3">
                        <a href="{{ route('public.lawyers.show', $teamMember) }}" class="pub-lawyer-card d-block text-decoration-none">
                            @if ($teamMember->hasMedia('photo'))
                                <img src="{{ $teamMember->getFirstMediaUrl('photo') }}" class="pub-lawyer-photo" alt="{{ $teamMember->name }}">
                            @else
                                <div class="pub-avatar-placeholder">{{ mb_substr($teamMember->name, 0, 1) }}</div>
                            @endif
                            <div class="pub-lawyer-body">
                                <h6>{{ $teamMember->name }}</h6>
                                <div class="pub-lawyer-title">{{ $teamMember->title }}</div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">{{ __('app.messages.no_results') }}</div>
                @endforelse
            </div>
        </div>
    </section>
</x-public-layout>
