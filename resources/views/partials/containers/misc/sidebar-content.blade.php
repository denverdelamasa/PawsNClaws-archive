<label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
<ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
  <!-- Sidebar content here -->
  @auth
    <upload-post></upload-post>
  @endauth
  <ul class="menu bg-base-100 border border-base-300 text-base-content p-4 my-2 rounded-xl">
    <h2>Shelters near you:</h2>
    <li><a>Registered Shelter</a></li>
    <li><a>Registered Shelter</a></li>
  </ul>
  <ul class="menu bg-base-100 border border-base-300 text-base-content p-4 my-2 rounded-xl">
    <h2>Shelters you may Like</h2>
    <li><a>Registered Shelter</a></li>
    <li><a>Registered Shelter</a></li>
  </ul>
</ul>