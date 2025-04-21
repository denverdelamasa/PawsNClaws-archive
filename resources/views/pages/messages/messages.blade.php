<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="{{ $theme ?? 'light' }}">
    @include('partials.main.scripts-styles', ['theme' => $theme])
    <body class="font-sans">
    @include('partials.main.navbar')
        <div id="app2">
            <user-messages></user-messages>
        </div>
    </body>
</html>

<style>
    /* Hide the scrollbar but allow scrolling */
    .hide-scrollbar::-webkit-scrollbar {
    display: none; /* Hides scrollbar in WebKit browsers */
    }

    .hide-scrollbar {
    -ms-overflow-style: none; /* Hides scrollbar in IE and Edge */
    scrollbar-width: none; /* Hides scrollbar in Firefox */
    overflow: auto; /* Ensure scrolling is enabled */
    }
    </style>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
    const uploadBox = document.getElementById('uploadBox');

    // Toggle visibility on scroll
    document.addEventListener('scroll', () => {
        if (window.scrollY === 0) {
        uploadBox.classList.add('hidden');
        uploadBox.classList.remove('block');
        } else {
        uploadBox.classList.add('block');
        uploadBox.classList.remove('hidden');
        }
        });
    });
</script>