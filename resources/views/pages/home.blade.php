@include('partials.main.head')

          <!-- Page content nato -->
          @include('partials.containers.misc.header')
        
          
          <post-card></post-card>
          @include('partials.containers.announcement.announcement-card')
          @include('partials.containers.event.event-card')

          @include('partials.misc.loader')

@include('partials.main.footer')