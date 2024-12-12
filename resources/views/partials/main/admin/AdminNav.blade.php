<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @include('partials.main.data-theme')>

@include('partials.main.scripts-styles')
@vite('resources/js/app.js')
        <body class="font-sans antialiased">