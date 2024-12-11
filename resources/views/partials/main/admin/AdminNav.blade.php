<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="night"> <!-- Page theme dapat responsive to sa theme button gagawin ko next time -->
@include('partials.main.scripts-styles')
@vite('resources/js/app.js')
        <body class="font-sans antialiased">