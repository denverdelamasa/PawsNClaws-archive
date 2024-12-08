@include('partials.main.head')

  
    @auth
      <upload-post></upload-post>
    @endauth
    
    @include('partials.containers.announcement.announcement-card')

    @include('partials.misc.loader')

@include('partials.main.footer')