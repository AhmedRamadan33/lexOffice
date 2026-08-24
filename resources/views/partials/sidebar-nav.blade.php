<ul class="nav flex-column mb-auto">
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="nav-icon"><i class="bi bi-speedometer2"></i></span>{{ __('app.nav.dashboard') }}
        </a>
    </li>
    @can('manage-clients')
    <li class="nav-item">
        <a href="{{ route('clients.index') }}" class="nav-link {{ request()->routeIs('clients.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="bi bi-people-fill"></i></span>{{ __('app.nav.clients') }}
        </a>
    </li>
    @endcan
    @can('manage-cases')
    <li class="nav-item">
        <a href="{{ route('cases.index') }}" class="nav-link {{ request()->routeIs('cases.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="bi bi-folder-fill"></i></span>{{ __('app.nav.cases') }}
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('sessions.index') }}" class="nav-link {{ request()->routeIs('sessions.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="bi bi-calendar-event-fill"></i></span>{{ __('app.nav.sessions') }}
        </a>
    </li>
    @endcan
    @can('manage-tasks')
    <li class="nav-item">
        <a href="{{ route('tasks.index') }}" class="nav-link {{ request()->routeIs('tasks.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="bi bi-check2-square"></i></span>{{ __('app.nav.tasks') }}
        </a>
    </li>
    @endcan
    @can('manage-invoices')
    <li class="nav-item">
        <a href="{{ route('invoices.index') }}" class="nav-link {{ request()->routeIs('invoices.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="bi bi-receipt"></i></span>{{ __('app.nav.invoices') }}
        </a>
    </li>
    @endcan
    @can('manage-expenses')
    <li class="nav-item">
        <a href="{{ route('expenses.index') }}" class="nav-link {{ request()->routeIs('expenses.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="bi bi-cash-stack"></i></span>{{ __('app.nav.expenses') }}
        </a>
    </li>
    @endcan

    @canany(['manage-cases', 'manage-users', 'manage-branches', 'view-activity-log'])
    <li class="nav-section-label mt-3 mb-2">{{ __('app.nav.settings') }}</li>
    @endcanany
    @can('manage-cases')
    <li class="nav-item">
        <a href="{{ route('courts.index') }}" class="nav-link {{ request()->routeIs('courts.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="bi bi-bank"></i></span>{{ __('app.nav.courts') }}
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('case-types.index') }}" class="nav-link {{ request()->routeIs('case-types.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="bi bi-tags-fill"></i></span>{{ __('app.nav.case_types') }}
        </a>
    </li>
    @endcan
    @can('manage-users')
    <li class="nav-item">
        <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="bi bi-person-badge-fill"></i></span>{{ __('app.nav.users') }}
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('roles.index') }}" class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="bi bi-shield-lock-fill"></i></span>{{ __('app.nav.roles') }}
        </a>
    </li>
    @endcan
    @can('manage-branches')
    <li class="nav-item">
        <a href="{{ route('branches.index') }}" class="nav-link {{ request()->routeIs('branches.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="bi bi-building"></i></span>{{ __('app.nav.branches') }}
        </a>
    </li>
    @endcan
    @can('view-activity-log')
    <li class="nav-item">
        <a href="{{ route('activity-log.index') }}" class="nav-link {{ request()->routeIs('activity-log.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="bi bi-clock-history"></i></span>{{ __('app.nav.activity_log') }}
        </a>
    </li>
    @endcan

    @can('manage-settings')
    <li class="nav-section-label mt-3 mb-2">{{ __('app.nav.site_content') }}</li>
    <li class="nav-item">
        <a href="{{ route('site-settings.edit') }}" class="nav-link {{ request()->routeIs('site-settings.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="bi bi-sliders"></i></span>{{ __('app.nav.site_settings') }}
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('practice-areas.index') }}" class="nav-link {{ request()->routeIs('practice-areas.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="bi bi-briefcase-fill"></i></span>{{ __('app.nav.practice_areas') }}
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('team-members.index') }}" class="nav-link {{ request()->routeIs('team-members.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="bi bi-person-video3"></i></span>{{ __('app.nav.team_members') }}
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('testimonials.index') }}" class="nav-link {{ request()->routeIs('testimonials.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="bi bi-chat-quote-fill"></i></span>{{ __('app.nav.testimonials') }}
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('success-stories.index') }}" class="nav-link {{ request()->routeIs('success-stories.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="bi bi-trophy-fill"></i></span>{{ __('app.nav.success_stories') }}
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('contact-messages.index') }}" class="nav-link {{ request()->routeIs('contact-messages.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="bi bi-envelope-fill"></i></span>{{ __('app.nav.contact_messages') }}
        </a>
    </li>
    @endcan
</ul>
