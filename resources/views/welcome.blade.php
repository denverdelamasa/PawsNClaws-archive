<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @include('partials.main.data-theme')>
@include('partials.main.scripts-styles')

    <body class="font-sans">
        @include('partials.main.home-nav')
        <section
            class="hero h-[70vh] group relative"
            style="
                background-image: url('{{ asset('images/pictures/pexels-wildlittlethingsphoto.jpg') }}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            "
            id="parallaxHero">
            <div class="hero-overlay bg-opacity-60"></div>
            <div class="hero-content text-neutral-content text-center">
                <div class="max-w-full">
                    <h1 class="mb-5 text-5xl font-bold">Discover, Share, and Connect – All in One Place!</h1>
                    <p class="mb-5">
                        Join a thriving community of pet lovers. Share your stories, find your next furry friend, or connect with Services near you!
                    </p>
                    @include('partials.misc.CTAHomeHero')
                </div>
            </div>
        
            <!-- Photographer Citation on Hover -->
            <div class="absolute bottom-2 left-2 bg-base-300 text-content text-xs p-2 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                Photographer: WildLittleThingsPhoto
            </div>
        </section>

        <section class="min-h-[80vh] text-base-content body-font align-middle items-center justify-center m-auto flex bg-base-300">
            <div class="container flex flex-col md:flex-wrap w-full h-full"> <!-- Make sure the container stretches fully -->
              <div class="flex md:w-1/2 w-auto m-6 md:m-auto gap-2"> <!-- Add gap property here -->
                <div class="w-full min-h-[50vh] bg-base-100 overflow-scroll hide-scrollbar rounded-xl shadow-xl hover:scale-105 tsansition-all duration-200">
                    <div id="app3">
                        <announcement-welcome></announcement-welcome> 
                    </div>
                </div>
              </div>  
              <div class="flex flex-col text-start justify-start md:w-1/2 w-full md:m-auto p-6">
                <h1 class="sm:text-5xl text-2xl font-medium title-font">See what's happening in our community!</h1>
                <p class="leading-relaxed md:text-base text-sm">
                    Stay up-to-date with the latest news and updates from the site, and discover what’s new in the community!
                </p>
              </div>                         
            </div>
        </section> 
            
        <section id="LearnMoreSection" class="min-h-[90vh] text-base-content body-font align-middle items-center justify-center m-auto flex bg-base-200">
            <div class="container flex flex-wrap w-full h-full"> <!-- Make sure the container stretches fully -->
              <div class="flex flex-col text-start justify-start md:w-1/2 w-full m-auto p-6">
                <h1 class="sm:text-5xl text-2xl font-medium title-font">Why Become Part of Our Community?</h1>
                <p class="leading-relaxed text-base">
                    Discover a platform designed to connect pet lovers, Services, and fosters. Share experiences, find new furry friends, and access exclusive resources that make a real difference in the world of pet adoption and care.
                </p>
              </div>
              <div class="flex flex-wrap md:w-1/2 w-full m-auto gap-2 p-4"> <!-- Add gap property here -->
                <div class="w-full">
                    <div class="w-full min-h-[150px] rounded-xl bg-base-300 shadow-lg hover:scale-105 transition-all duration-200">
                        <div class="w-full h-auto rounded-xl bg-base-300 shadow-lg p-4 flex flex-row items-center">
                            <div class="group relative w-full h-[150px] mb-4 rounded-lg">
                                <!-- Hoverable Image Div (smaller) -->
                                <div class="bg-cover bg-center w-full h-[150px] rounded-lg"
                                  style="background-image: url('/images/pictures/pexels-vatius.jpg');">
                                </div>
                                <!-- Tooltip content appears on hover -->
                                <div class="absolute bottom-2 left-2 bg-base-300 text-content text-xs p-2 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                                  Photographer: Vatius
                                </div>
                            </div>
                            <!-- Text Content -->
                            <div class="text-center">
                                <h2 class="text-xl font-bold mb-2">
                                    Adopt Your Best Friend:
                                </h2>
                                <p class="text-sm">
                                    Find your perfect companion from pets eagerly waiting for a loving home.
                                </p>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="flex flex-row w-full gap-2 mt-8">
                    <div class="w-1/2">
                        <div class="w-full h-auto rounded-xl bg-base-300 shadow-lg p-4 hover:scale-105 transition-all duration-200">
                            <div class="group relative w-full h-[100px] mb-4 rounded-xl">
                                <!-- Hoverable Image Div (smaller) -->
                                <div class="bg-cover bg-center w-full h-full rounded-xl"
                                    style="background-image: url('/images/pictures/pexels-tima-miroshnichenko.jpg');">
                                </div>
                            
                                <!-- Tooltip content appears on hover -->
                                <div class="absolute bottom-2 left-2 bg-base-300 text-content text-xs p-2 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                                    Photographer: Tima Miroshnichenko
                                </div>
                            </div>
                            <!-- Text Content -->
                            <div class="text-center">
                                <h2 class="text-xl font-bold mb-2">
                                    Engage with Experts:
                                </h2>
                                <p class="text-sm">
                                    Get tips and advice from experienced pet care professionals and enthusiasts.
                                </p>
                            </div>
                        </div>                          
                    </div>
                    <div class="w-1/2">
                        <div class="w-full h-auto rounded-xl bg-base-300 shadow-lg p-4 hover:scale-105 transition-all duration-200">
                            <div class="group relative w-full h-[100px] mb-4 rounded-xl">
                                <!-- Hoverable Image Div (smaller) -->
                                <div class="bg-cover bg-center w-full h-full rounded-xl"
                                    style="background-image: url('/images/pictures/pexels-sam-lion.jpg');">
                                </div>
                            
                                <!-- Tooltip content appears on hover -->
                                <div class="absolute bottom-2 left-2 bg-base-300 text-content text-xs p-2 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                                    Photographer: Sam Lion
                                </div>
                            </div>
                            
                            <!-- Text Content -->
                            <div class="text-center">
                              <h2 class="text-xl font-bold mb-2">Find Events Near You:</h2>
                                <p class="text-sm">
                                    Stay updated on adoption drives, pet shows, and community activities.
                                </p>
                            </div>
                        </div>                          
                    </div>
                </div>
              </div>                           
            </div>
        </section> 

        <section class="text-base-content body-font bg-base-100">
            <div class="container px-5 py-24 mx-auto ">
                <div class="flex flex-col text-center w-full mb-10">
                    <h1 class="sm:text-5xl text-4xl font-medium title-font">Have Questions?</h1>
                </div>
                <div class="flex flex-wrap md:flex-col gap-8">
                    <div class="card w-full bg-base-200 shadow-xl">
                        <div class="card-body">
                            <h2 class="card-title text-lg sm:text-xl mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-16 h-16" viewBox="0 0 16 16">
                                    <path d="M8.05 9.6c.336 0 .504-.24.554-.627.04-.534.198-.815.847-1.26.673-.475 1.049-1.09 1.049-1.986 0-1.325-.92-2.227-2.262-2.227-1.02 0-1.792.492-2.1 1.29A1.7 1.7 0 0 0 6 5.48c0 .393.203.64.545.64.272 0 .455-.147.564-.51.158-.592.525-.915 1.074-.915.61 0 1.03.446 1.03 1.084 0 .563-.208.885-.822 1.325-.619.433-.926.914-.926 1.64v.111c0 .428.208.745.585.745"/>
                                    <path d="m10.273 2.513-.921-.944.715-.698.622.637.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.636a2.89 2.89 0 0 1 4.134 0l-.715.698a1.89 1.89 0 0 0-2.704 0l-.92.944-1.32-.016a1.89 1.89 0 0 0-1.911 1.912l.016 1.318-.944.921a1.89 1.89 0 0 0 0 2.704l.944.92-.016 1.32a1.89 1.89 0 0 0 1.912 1.911l1.318-.016.921.944a1.89 1.89 0 0 0 2.704 0l.92-.944 1.32.016a1.89 1.89 0 0 0 1.911-1.912l-.016-1.318.944-.921a1.89 1.89 0 0 0 0-2.704l-.944-.92.016-1.32a1.89 1.89 0 0 0-1.912-1.911z"/>
                                    <path d="M7.001 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0"/>                                </svg>
                                What is Paws'N Claws?
                            </h2>
                            <p class="leading-relaxed mb-4">
                                Paws'N Claws is a website dedicated to helping people find homes for stray pets or rehome pets they can no longer care for due to various reasons. It unites the local community through shared love for domesticated animals, enabling involvement and volunteerism by providing information about events and activities.
                            </p>
                        </div>
                    </div>
            
                    <div class="card w-full bg-base-200 shadow-xl">
                        <div class="card-body">
                            <h2 class="card-title text-lg sm:text-xl mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-16 h-16" viewBox="0 0 16 16">
                                    <path d="M7 7a1 1 0 0 1 2 0v1H7z"/>
                                    <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M10 7v1.076c.54.166 1 .597 1 1.224v2.4c0 .816-.781 1.3-1.5 1.3h-3c-.719 0-1.5-.484-1.5-1.3V9.3c0-.627.46-1.058 1-1.224V7a2 2 0 1 1 4 0"/>
                                </svg>
                                Is my personal information secure?
                            </h2>
                            <p class="leading-relaxed mb-4">
                                Paws N' Claws only collects personal information necessary for facilitating transactions, verifications, and communication. (Our <a href="{{ url('/privacy-policy') }}" class="text-primary underline">Privacy Policy</a> outlines how we collect, store, and use data.)
                            </p>
                        </div>
                    </div>
            
                    <div class="card w-full bg-base-200 shadow-xl">
                        <div class="card-body">
                            <h2 class="card-title text-lg sm:text-xl mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-16 h-16" viewBox="0 0 16 16">
                                    <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m0 5.996V14H3s-1 0-1-1 1-4 6-4q.845.002 1.544.107a4.5 4.5 0 0 0-.803.918A11 11 0 0 0 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664zM9 13a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1"/>
                                </svg>
                                How do I log in or reset my password?
                            </h2>
                            <p class="leading-relaxed mb-4">
                                If you forget your password, you can reset it by following the instructions in the automated email sent to your registered email address.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Testimonials wag muna
            <section class="flex h-[80vh] bg-base-200 text-base-content">
                <div class="container m-auto">
                <h1 class="text-5xl font-medium title-font text-base-content mb-12 text-center">Testimonials</h1>
                <div class="flex flex-wrap">
                    <div class="p-4 md:w-1/2 w-full">
                    <div class="h-full bg-base-200 p-8 rounded">
                        <svg xmlns="https://www.w3.org/2000/svg" fill="currentColor" class="block w-5 h-5 text-base-content/50 mb-4" viewBox="0 0 975.036 975.036">
                        <path d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z"></path>
                        </svg>
                        <p class="leading-relaxed mb-6">
                            *Future Testimonies*
                        </p>
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
                        <svg xmlns="https://www.w3.org/2000/svg" fill="currentColor" class="block w-5 h-5 text-base-content/50 mb-4" viewBox="0 0 975.036 975.036">
                        <path d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z"></path>
                        </svg>
                        <p class="leading-relaxed mb-6">
                            *Future Testimonies*
                        </p>
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
        -->
        
    </body>

    <footer class="footer bg-base-300 text-base-content p-4 text-xs p-12">
        <nav>
          <h6 class="footer-title text-xs">Contents</h6>
          <a class="link link-hover">Posts</a>
          <a class="link link-hover">Announcements</a>
          <a class="link link-hover">Events</a>
          <a class="link link-hover">Services</a>
        </nav>
        <nav>
          <h6 class="footer-title text-xs">Site</h6>
            @guest
                <a class="link link-hover" href="{{ url('/login') }}">Log in</a>
                <a class="link link-hover" href="{{ url('/signup') }}">Sign Up</a>
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
                <svg xmlns="https://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current">
                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path>
                </svg>
            </a>
            <a>
                <svg xmlns="https://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current">
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

    // Theme switching functionality
    document.querySelectorAll('[data-theme]').forEach(item => {
      item.addEventListener('click', (event) => {
        const theme = event.target.getAttribute('data-theme');
        document.documentElement.setAttribute('data-theme', theme); // Update the theme
        localStorage.setItem('theme', theme); // Save theme preference
      });
    });
</script>