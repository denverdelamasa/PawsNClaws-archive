<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="night"> <!-- Page theme dapat responsive to sa theme button gagawin ko next time -->
@include('partials.main.scripts-styles')
    <body class="font-sans antialiased">
        @include('partials.main.navbar')
      
        <section
            class="hero min-h-[70vh]"
            style="
            background-image: url('{{ asset('images/pictures/pexels-wildlittlethingsphoto.jpg') }}');
            background-size: cover;
            background-position: center;
            "
            id="parallaxHero">
            <div class="hero-overlay bg-opacity-60"></div>
            <div class="hero-content text-neutral-content text-center">
                <div class="max-w-full">
                    <h1 class="mb-5 text-8xl font-bold">Discover, Share, and Connect – All in One Place!</h1>
                    <p class="mb-5">
                        Join a thriving community of pet lovers. Share your stories, find your next furry friend, or connect with shelters near you!
                    </p>
                    @include('partials.misc.CTAHomeHero')
                </div>
            </div>
        </section>
      
        <section class="h-[80vh] text-base-content body-font align-middle items-center justify-center m-auto flex">
            <div class="container flex flex-row w-full h-full"> <!-- Make sure the container stretches fully -->
              <div class="flex flex-col text-start justify-start w-1/2 m-auto p-2">
                <h1 class="sm:text-5xl text-2xl font-medium title-font text-primary">Why Become Part of Our Community?</h1>
                <p class="leading-relaxed text-base text-secondary">
                    Discover a platform designed to connect pet lovers, shelters, and fosters. Share experiences, find new furry friends, and access exclusive resources that make a real difference in the world of pet adoption and care.
                </p>
              </div>
              <div class="flex flex-wrap w-1/2 m-auto gap-2"> <!-- Add gap property here -->
                <div class="w-full">
                  <div class="w-full h-[300px] rounded-xl bg-base-300 shadow-lg"></div> <!-- A box replacing the image -->
                </div>
                <div class="flex flex-row w-full gap-2">
                    <div class="w-1/2">
                      <div class="w-full h-[150px] rounded-xl bg-base-300 shadow-lg"></div> <!-- A box replacing the image -->
                    </div>
                    <div class="w-1/2">
                      <div class="w-full h-[150px] rounded-xl bg-base-300 shadow-lg"></div> <!-- A box replacing the image -->
                    </div>
                </div>
              </div>                           
            </div>
        </section>    
          
        <section class="h-[80vh] w-full bg-base-300">
        </section>
        <section class="flex h-[80vh] bg-base-100 text-base-content">
            <div class="container m-auto">
              <h1 class="text-5xl font-medium title-font text-base-content mb-12 text-center">Testimonials</h1>
              <div class="flex flex-wrap">
                <div class="p-4 md:w-1/2 w-full">
                  <div class="h-full bg-base-200 p-8 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="block w-5 h-5 text-base-content/50 mb-4" viewBox="0 0 975.036 975.036">
                      <path d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z"></path>
                    </svg>
                    <p class="leading-relaxed mb-6">Synth chartreuse iPhone lomo cray raw denim brunch everyday carry neutra before they sold out fixie 90's microdosing. Tacos pinterest fanny pack venmo, post-ironic heirloom try-hard pabst authentic iceland.</p>
                    <a class="inline-flex items-center">
                      <img alt="testimonial" src="https://dummyimage.com/106x106" class="w-12 h-12 rounded-full flex-shrink-0 object-cover object-center">
                      <span class="flex-grow flex flex-col pl-4">
                        <span class="title-font font-medium text-base-content">Holden Caulfield</span>
                        <span class="text-base-content/60 text-sm">UI DEVELOPER</span>
                      </span>
                    </a>
                  </div>
                </div>
                <div class="p-4 md:w-1/2 w-full">
                  <div class="h-full bg-base-200 p-8 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="block w-5 h-5 text-base-content/50 mb-4" viewBox="0 0 975.036 975.036">
                      <path d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z"></path>
                    </svg>
                    <p class="leading-relaxed mb-6">Synth chartreuse iPhone lomo cray raw denim brunch everyday carry neutra before they sold out fixie 90's microdosing. Tacos pinterest fanny pack venmo, post-ironic heirloom try-hard pabst authentic iceland.</p>
                    <a class="inline-flex items-center">
                      <img alt="testimonial" src="https://dummyimage.com/107x107" class="w-12 h-12 rounded-full flex-shrink-0 object-cover object-center">
                      <span class="flex-grow flex flex-col pl-4">
                        <span class="title-font font-medium text-base-content">Alper Kamu</span>
                        <span class="text-base-content/60 text-sm">DESIGNER</span>
                      </span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
        </section>



    </body>

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
                <a class="link link-hover">Log in</a>
                <a class="link link-hover">Sign Up</a>
            @endguest
          <a class="link link-hover">About us</a>
          <a class="link link-hover">Contact</a>
          <a class="link link-hover">Apply</a>
        </nav>
        <nav>
          <h6 class="footer-title text-xs">Legal</h6>
          <a class="link link-hover">Terms of use</a>
          <a class="link link-hover">Privacy policy</a>
          
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
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current">
                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path>
                </svg>
            </a>
            <a>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current">
                    <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"></path>
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

    /* From Uiverse.io by elijahgummer */ 
    .HeroBGContainer {
    background: lightblue;
    position: relative;
    overflow: hidden;
    }

    .HeroBGContainer::before {
    content: "";
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, #3498db 10%, transparent 20%),
        radial-gradient(circle, transparent 10%, #3498db 20%);
    background-size: 30px 30px; /* Adjust the size of the pattern */
    animation: moveBackground 8s linear infinite; /* Adjust the animation duration and timing function */
    }

    @keyframes moveBackground {
    0% {
        transform: translate(0, 0);
    }
    100% {
        transform: translate(20%, 20%);
    }
    }
    #parallaxHero {
    background-attachment: scroll;
    background-position: center;
    transition: background-position 0.1s ease-out;
  }

</style>
<script>
    const hero = document.getElementById("parallaxHero");
  
    window.addEventListener("scroll", () => {
      const scrollPosition = window.scrollY;
      hero.style.backgroundPosition = `center ${scrollPosition * 0.5}px`;
    });
</script>