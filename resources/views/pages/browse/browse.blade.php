@include('partials.main.head')

<div id="app2">
  <div class="drawer lg:drawer-open">
      <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
      <div class="drawer-content flex flex-col items-center justify-start overflow-y-auto my-2 mx-4">
          <!-- Page content nato -->
          @include('partials.containers.misc.header')
        

          @include('partials.misc.loader')
      </div>
      <div class="drawer-side">
        @include('partials.containers.misc.sidebar-content')
      </div>
  </div>
</div>

@include('partials.main.footer')