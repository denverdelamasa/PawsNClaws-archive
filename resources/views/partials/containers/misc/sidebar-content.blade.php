<label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
<ul id="SidebarPadding" class="menu bg-base-200 text-base-content min-h-full w-80 p-4 z-50 @auth pt-20 lg:pt-20 @endauth @guest pt-20 @endguest">
  <!-- Sidebar content here -->
  <upload-post></upload-post>
  <ul class="menu bg-base-100 border border-base-300 text-base-content p-4 my-2 rounded-xl">
    <h2>Shelters you may Like</h2>
    <li><a>Registered Shelter</a></li>
    <li><a>Registered Shelter</a></li>
  </ul>

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
      <a class="link link-hover">Terms of use</a>
      <a class="link link-hover">Privacy policy</a>
      <a class="link link-hover">Cookie policy</a>
    </nav>
  </footer>
</ul>

<script>
  // PostCardDivObserved
  // PostCardDiv
  document.addEventListener("DOMContentLoaded", () => {
    const PostCardDivObserved = document.getElementById("PostCardDivObserved");
    const PostCardDiv = document.getElementById("PostCardDiv");

    const observer = new IntersectionObserver(
      (entries) => {
        const entry = entries[0];
        if (entry.isIntersecting) {
          // Observed div is visible
          PostCardDiv.classList.add("hidden");
          SidebarPadding.classList.add("lg:pt-0");
          SidebarPadding.classList.remove("lg:pt-20");
        } else {
          // Observed div is not visible
          PostCardDiv.classList.remove("hidden");
          SidebarPadding.classList.remove("lg:pt-0");
          SidebarPadding.classList.add("lg:pt-20");
        }
      },
      { threshold: 0.1 } // Trigger when at least 10% of the observed div is visible
    );

    observer.observe(PostCardDivObserved);
  });
</script>