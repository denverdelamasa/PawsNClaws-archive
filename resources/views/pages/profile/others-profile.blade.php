<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @include('partials.main.data-theme')>
@include('partials.main.scripts-styles')    
    <body class="font-sans">
        @include('partials.main.navbar')

        <div id="app2">
            <view-account :user-id="userId"></view-account>
        </div>

        <script>
            const urlParams = new URLSearchParams(window.location.search);
            const userId = urlParams.get('user_id') || null;
            console.log('Extracted userId from URL:', userId);

            const app2 = Vue.createApp({
                data() {
                    return {
                        userId: userId
                    };
                }
            });

            app2.component('view-account', ViewAccount); // assuming ViewAccount is defined globally or imported
            app2.mount('#app2');
        </script>

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