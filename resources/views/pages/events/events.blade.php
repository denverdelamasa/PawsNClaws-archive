@include('partials.main.head')

    @auth
      <upload-post></upload-post>
    @endauth
    
    <event-cards></event-cards>

@include('partials.main.footer')