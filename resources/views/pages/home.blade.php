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
          <li><a>Sidebar Item 1</a></li>
          <li><a>Sidebar Item 2</a></li>
        </ul>
      </div>
  </div>
</div>

@include('partials.main.footer')