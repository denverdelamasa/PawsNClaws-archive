@include('partials.main.head')

    <!-- Page content nato -->
    @include('partials.containers.misc.header')
  
    @auth
      <upload-post></upload-post>
    @endauth
    
    @include('partials.containers.announcement.announcement-card')

    @include('partials.misc.loader')

@include('partials.main.footer')