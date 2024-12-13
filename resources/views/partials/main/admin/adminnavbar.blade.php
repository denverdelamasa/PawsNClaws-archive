<div class="navbar bg-base-300 sticky top-0 z-20">
    <div class="navbar-start">
      <label for="AdminSideBar" aria-label="open sidebar" class="btn btn-square btn-ghost lg:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-window-sidebar" viewBox="0 0 16 16">
            <path d="M2.5 4a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1m2-.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m1 .5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
            <path d="M2 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v2H1V3a1 1 0 0 1 1-1zM1 13V6h4v8H2a1 1 0 0 1-1-1m5 1V6h9v7a1 1 0 0 1-1 1z"/>
        </svg>
      </label>
      @include('partials.main.logo')
    </div>
    <div class="navbar-end">
      @auth
            <!-- Notifications -->
            <div id="app">
              <notifications></notifications>
            </div>
            <!-- Profile -->
            <div class="dropdown dropdown-end">
              <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                  <div class="w-10 rounded-full">
                      <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('storage/images/defaultpics/defaultuserprofile.jpg') }}" 
                          alt="{{ Auth::user()->username }}" />
                  </div>
              </div>
              <ul
                tabindex="0"
                class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow gap-y-2">
                <li><a href="{{ route('client.profile.edit') }}">Profile</a></li>
                @auth
                  @if(Auth::user()->role === 'Admin')
                    <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                  @endif
                @endauth
                <li>
                  <!-- Authentication -->
                  <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <a 
                      href="#" 
                      onclick="event.preventDefault(); this.closest('form').submit();" 
                    >
                      {{ __('Log Out') }}
                    </a>
                  </form>
                </li>
              </ul>

          </div>
      @endauth           
    </div>
</div>