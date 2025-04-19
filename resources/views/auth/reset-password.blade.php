<x-guest-layout>
  <div class="hero bg-base-200 min-h-screen">
    <div class="hero-content flex-col justify-center items-center w-full">
      <div class="card bg-base-100 w-full max-w-md shadow-2xl p-8">
        <!-- Logo -->
        <div class="flex justify-center">
            <img src="/images/pictures/logo.jpg" alt="Cat Paw Logo" class="w-[120px] h-[120px] mb-4 rounded-full object-cover object-center">
        </div>

        <!-- Title and Subtitle -->
        <h2 class="text-3xl font-bold text-center text-base-content mb-2">Reset Your Password</h2>
        <p class="text-center text-base-content opacity-70 mb-6">Help your furry friends find you again!</p>

        <!-- Form -->
        <form method="POST" action="{{ route('password.store') }}">
          @csrf
          <input type="hidden" name="token" value="{{ $request->route('token') }}">

          <!-- Email -->
          <div class="form-control mb-4">
            <x-input-label for="email" :value="__('Email')" class="text-base-content font-medium" />
            <x-text-input id="email" class="input input-bordered mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-error" />
          </div>

          <!-- Password -->
          <div class="form-control mb-4">
            <x-input-label for="password" :value="__('Password')" class="text-base-content font-medium" />
            <x-text-input id="password" class="input input-bordered mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-error" />
          </div>

          <!-- Confirm Password -->
          <div class="form-control mb-6">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-base-content font-medium" />
            <x-text-input id="password_confirmation" class="input input-bordered mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-error" />
          </div>

          <!-- Submit -->
          <div class="form-control">
            <button type="submit" class="btn btn-primary w-full">
              Reset Password
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-guest-layout>
