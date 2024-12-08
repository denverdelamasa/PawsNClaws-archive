<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark"> <!-- Page theme dapat responsive to sa theme button gagawin ko next time -->
    @include('partials.main.scripts-styles')
    <body class="font-sans antialiased">
        @include('partials.main.navbar')
      
        <div id="app2">
            <div class="drawer lg:drawer-open">
                <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
                    <div class="drawer-content flex flex-col items-center justify-start overflow-y-auto my-2 mx-4 lg:pl-12 lg:pr-36 px-6">