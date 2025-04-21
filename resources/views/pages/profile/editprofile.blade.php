<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @include('partials.main.data-theme')>
@include('partials.main.scripts-styles')    
<body class="font-sans">
    @include('partials.main.navbar')      
    <div id="app2">
        <div class="max-w-3xl mx-auto p-4 bg-base-200 m-4 rounded-md shadow-lg">
            <h1 class="text-3xl font-bold mb-6">Profile Settings</h1>
            @include('pages.profile.partials.profile-pic-section')
        </div>
    </div>
</body>
</html>