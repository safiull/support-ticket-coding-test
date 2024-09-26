<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand justify-content-center">
        <a href="{{ url('/') }}" class="app-brand-link gap-2">
            <h4 class="mt-3">Support Task</h4>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-item {{ Route::is('customer.supports.index', 'customer.supports.create', 'customer.supports.show') ? 'active' :'' }}">
            <a href="{{ route('customer.supports.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bx-support'></i>
                <div>{{ __('Supports') }}</div>
            </a>
        </li>
    </ul>
</aside>
