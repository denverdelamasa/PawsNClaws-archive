@include('partials.main.head')
<div id="app2">
  <div class="drawer lg:drawer-open">
      <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
      <div class="drawer-content flex flex-col items-center justify-start overflow-y-auto my-2 mx-4">
          <!-- Page content nato -->
          @include('partials.containers.misc.header')
        
          @auth
            <upload-post></upload-post>
          @endauth
          
          @include('partials.containers.post.post-card')
          @include('partials.containers.announcement.announcement-card')
          @include('partials.containers.event.event-card')
      </div>
      <div class="drawer-side">
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
      </div>
  </div>
</div>

@include('partials.main.footer')