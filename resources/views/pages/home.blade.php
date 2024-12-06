@include('partials.main.head')

<div class="drawer lg:drawer-open">
    <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content flex flex-col items-center justify-start overflow-y-auto my-2 mx-4">
        <!-- Page content nato -->
        @include('partials.containers.misc.header')
      
        @include('partials.containers.input.post-box')
        @include('partials.containers.post.post-card')

        @include('partials.containers.announcement.announcement-card')
        @include('partials.containers.event.event-card')
    </div>
    <div class="drawer-side">
        @include('partials.containers.misc.sidebar-content')
    </div>
</div>

@include('partials.main.footer')