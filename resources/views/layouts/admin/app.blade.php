<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' | ' : '' }} {{ env('APP_NAME') }}</title>
    @include('layouts.admin.partials.styles')
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('layouts.admin.partials.sidebar')

            <div class="layout-page">
                @include('layouts.admin.partials.topbar')

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row justify-content-between pb-2">
                            <div class="col">
                                <h5 class="fw-bold"><span class="text-muted fw-light"><a href="{{ route('admin.supports.index') }}"><i class="tf-icons bx bx-home-circle"></i> Dashboard</a></span> / {{ $title ?? '' }}</h5>
                            </div>
                            <div class="col text-end">
                                @foreach ($buttons ?? [] as $button)
                                    @can($button['can'] ?? false)
                                    <a href="{{ $button['link'] ?? 'javascript:void(0)' }}" {{ isset($button['modal']) ? 'data-bs-toggle=modal data-bs-target=#'.$button['modal'] : '' }} class="btn btn-primary btn-sm me-1"><i class='{{ $button['icon'] }}'></i> {{ $button['name'] }}</a>
                                    @endcan
                                @endforeach
                            </div>
                        </div>

                        @yield('contents')
                        @stack('modal')
                    </div>

                    @include('layouts.admin.partials.footer')
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    @include('layouts.admin.partials.scripts')

</body>

</html>
