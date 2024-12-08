@include('partials.main.head')

  
    @auth
      <upload-post></upload-post>
    @endauth
    
    @include('partials.containers.post.post-card')

    @include('partials.misc.loader')

@include('partials.main.footer')