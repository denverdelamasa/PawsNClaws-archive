@include('partials.main.head')

<div class="hero bg-base-200 min-h-screen">
  <div class="hero-content flex-col lg:flex-row-reverse justify-center items-center w-full">
    <div class="text-center lg:text-left w-full lg:w-1/2 flex flex-col justify-center items-center lg:items-start lg:justify-start">
      <h1 class="text-8xl font-bold">Login now!</h1>
      <p class="py-6 w-2/3 lg:w-full">
        Log in to Your Account and Engage with the Community to Access Exclusive Features
      </p>
    </div>
    <div class="card bg-base-100 w-full max-w-sm shrink-0 shadow-2xl">
      <form class="card-body" method="POST" action="{{ route('login') }}">
        @csrf
        <!-- Email Address -->
        <div class="form-control my-4">
          <label class="flex items-center gap-2">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 16 16"
              fill="currentColor"
              class="h-4 w-4 opacity-70">
              <path
                d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
              <path
                d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
            </svg>
            <input type="email" class="input input-bordered grow" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required autofocus />
          </label>
          @error('email')
            <span class="text-error text-sm mt-1">{{ $message }}</span>
          @enderror
        </div>

        <!-- Password -->
        <div class="form-control my-4">
          <label class="flex items-center gap-2">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 16 16"
              fill="currentColor"
              class="h-4 w-4 opacity-70">
              <path
                fill-rule="evenodd"
                d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z"
                clip-rule="evenodd" />
            </svg>
            <input type="password" class="input input-bordered grow" name="password" id="password" placeholder="Password" required />
          </label>
          @error('password')
            <span class="text-error text-sm mt-1">{{ $message }}</span>
          @enderror
        </div>

        <!-- Login Button -->
        <div class="form-control mt-6">
          <button type="submit" class="btn btn-primary">Login</button>
        </div>

        <!-- Register Link -->
        <p class="mt-4 text-center">Don't have an account? <a href="{{ url('/signup') }}" class="link link-primary">Sign Up here</a></p>
      </form>
    </div>
  </div>
</div>

@include('partials.main.footer')
