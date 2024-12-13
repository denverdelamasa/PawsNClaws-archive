@include('partials.main.head')

  
  <div id="uploadBox">
    @auth
      <upload-post></upload-post>
    @endauth
  </div>
    
    @include('partials.containers.event.event-card')

@include('partials.main.footer')