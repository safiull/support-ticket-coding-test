<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }} | {{ $title ?? '' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.auth.partials.styles')
</head>

<body>

    @yield('contents')
    @include('layouts.auth.partials.scripts')
</body>

</html>
