<section>
    <header>
        <h2 class="text-lg font-medium text-base-400">
            {{ __('Profile Picture') }}
        </h2>

        <p class="mt-1 text-sm text-base-200">
            {{ __("Update your account's profile picture.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Display Current Profile Picture with Circle Crop -->
        <div class="flex justify-center">
            <div class="profile-picture-wrapper">
                <img src="{{ Auth::user()->profile_picture ? Storage::url(Auth::user()->profile_picture) : asset('storage/images/defaultpics/defaultuserprofile.jpg') }}" 
                    alt="Profile Picture" 
                    class="profile-picture" 
                />
            </div>
        </div>

        <div>
            <x-input-label for="profile_picture" :value="__('Profile Picture')" />
            <input id="profile_picture" name="profile_picture" type="file" class="mt-1 block w-full" accept="image/*" />
            <x-input-error class="mt-2" :messages="$errors->get('profile_picture')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-pic-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-base-200"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<!-- CSS Styles -->
<style>
    .profile-picture-wrapper {
        width: 120px; /* Desired profile picture size */
        height: 120px;
        overflow: hidden;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .profile-picture {
        width: 150%; /* Zoom-in effect */
        height: auto;
        object-fit: cover;
    }
</style>