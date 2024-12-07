@include('partials.main.head')

    <!-- Page content nato -->
    @include('partials.containers.misc.header')
  
    @auth
      <upload-post></upload-post>
    @endauth
    
    @include('partials.containers.event.event-card')

    @include('partials.misc.loader')

@include('partials.main.footer')