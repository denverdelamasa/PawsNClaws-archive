<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="{{ $theme }}">
    @include('partials.main.scripts-styles')
    <body class="font-sans antialiased">
        @include('partials.main.navbar')
      
        <div id="app2">
                <browse></browse> <!-- Vue component will be rendered here -->
        </div>

    <footer class="footer bg-base-300 text-base-content p-4 text-xs">
        <nav>
          <h6 class="footer-title text-xs">Contents</h6>
          <a class="link link-hover">Posts</a>
          <a class="link link-hover">Announcements</a>
          <a class="link link-hover">Events</a>
          <a class="link link-hover">Shelters</a>
        </nav>
        <nav>
            <h6 class="footer-title text-xs">Site</h6>
            @guest
                <a class="link link-hover"  href="{{ url('form/login') }}">Log in</a>
                <a class="link link-hover"  href="{{ url('form/signup') }}">Sign Up</a>
            @endguest
            <a class="link link-hover">About us</a>
            <a class="link link-hover">Contact</a>
            <a class="link link-hover">Apply</a>
        </nav>
        <nav>
          <h6 class="footer-title text-xs">Legal</h6>
          <a class="link link-hover" href="{{ url('terms-of-service') }}">Terms of Service</a>
          <a class="link link-hover" href="{{ url('privacy-policy') }}">Privacy policy</a>
          
        </nav>
    </footer>
    <footer class="footer bg-base-300 text-base-content border-base-300 border-t px-10 py-4">
        <aside class="grid-flow-col items-center">
            <p>
                Paws'N Claws    
            </p>
        </aside>
        <nav class="md:place-self-center md:justify-self-end">
            <div class="grid grid-flow-col gap-4">
            <a>
                <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                class="fill-current">
                <path
                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path>
                </svg>
            </a>
            <a>
                <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                class="fill-current">
                <path
                    d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"></path>
                </svg>
            </a>
            <a>
                <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                class="fill-current">
                <path
                    d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path>
                </svg>
            </a>
            </div>
        </nav>
    </footer>
    
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

<style>
    .feed-loader{
    position: relative;
    width: 450px;
    height: 240px;
    margin-bottom: 10px;
    padding: 15px;
    overflow: hidden;
    }

    .feed-loader:after {
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: linear-gradient(110deg, rgba(227, 227, 227, 0) 0%, rgba(227, 227, 227, 0) 40%, rgba(207, 207, 207, 0.5) 50%, rgba(227, 227, 227, 0) 60%, rgba(227, 227, 227, 0) 100%);
    animation: gradient-animation_2 1.2s linear infinite;
    }

    .feed-loader .wrapper {
    width: 100%;
    height: 100%;
    position: relative;
    }

    .feed-loader .circle {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    }

    .feed-loader .button {
    display: inline-block;
    height: 32px;
    width: 75px;
    }

    .feed-loader .line-1 {
    position: absolute;
    top: 11px;
    left: 58px;
    height: 10px;
    width: 100px;
    }

    .feed-loader .line-2 {
    position: absolute;
    top: 34px;
    left: 58px;
    height: 10px;
    width: 150px;
    }

    .feed-loader .line-3 {
    position: absolute;
    top: 57px;
    left: 0px;
    height: 10px;
    width: 100%;
    }

    .feed-loader .line-4 {
    position: absolute;
    top: 80px;
    left: 0px;
    height: 10px;
    width: 92%;
    }

    @keyframes gradient-animation_2 {
    0% {
        transform: translateX(-100%);
    }

    100% {
        transform: translateX(100%);
    }
    }
</style>

<script>
    app2.component('browse', Browse);
    app2.mount('#app2');
</script>