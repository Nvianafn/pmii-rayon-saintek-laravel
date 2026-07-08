<!DOCTYPE html>
<html lang="id">
<head>
@php $pageTitle = $title ?? null; @endphp
@include('partials.head-meta')
@vite(['resources/css/app.css', 'resources/js/app.js'])
@stack('styles')
</head>
<body>

@include('partials.nav')

<main>
    {{ $slot }}
</main>

@include('partials.footer')

@stack('scripts')
</body>
</html>
