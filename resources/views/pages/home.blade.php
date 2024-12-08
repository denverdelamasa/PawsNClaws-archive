@include('partials.main.head')

        
          @auth
            <upload-post></upload-post>
          @endauth
          
          @include('partials.containers.post.post-card')
          @include('partials.containers.announcement.announcement-card')
          @include('partials.containers.event.event-card')

@include('partials.main.footer')