<label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
<ul id="SidebarPadding" class="menu bg-base-200 text-base-content min-h-full w-80 p-4 z-50 @auth pt-20 lg:pt-20 @endauth @guest pt-20 @endguest">
  @auth
    <a href="#">
      <div class="card bg-base-200 shadow-md w-full max-w-full border border-base-300 p-4 hidden" id="uploadBox">
        <div class="flex items-start gap-4">
          <div class="flex-grow">
            <div class="flex items-center justify-start bg-base-300 p-3 rounded-full hover:bg-base-100 duration-200 transition-all">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil mr-2" viewBox="0 0 16 16">
                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
              </svg>
              Share your thoughts!
            </div>
          </div>
        </div>
      </div>
    </a>
  @endauth

  <footer class="absolute bottom-4 bg-base-300 text-base-content p-4 text-xs flex flex-row gap-x-4 justify-between rounded-xl border border-base-300">
    <nav class="flex flex-col gap-y-2">
      <h6 class="footer-title text-xs">Contents</h6>
      <a class="link link-hover">Posts</a>
      <a class="link link-hover">Announcements</a>
      <a class="link link-hover">Events</a>
      <a class="link link-hover">Shelters</a>
    </nav>
    <nav class="flex flex-col gap-y-2">
      <h6 class="footer-title text-xs">Site</h6>
      @guest
        <a class="link link-hover">Log in</a>
        <a class="link link-hover">Sign Up</a>
      @endguest
      <a class="link link-hover">About us</a>
      <a class="link link-hover">Contact</a>
      <a class="link link-hover">Apply</a>
    </nav>
    <nav class="flex flex-col gap-y-2">
      <h6 class="footer-title text-xs">Legal</h6>
      <a class="link link-hover" href="{{ url('terms-of-service') }}">Terms of Service</a>
      <a class="link link-hover" href="{{ url('privacy-policy') }}">Privacy policy</a>
      
    </nav>
  </footer>
</ul>