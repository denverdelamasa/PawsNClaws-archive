<section class="mb-10">
    <header>
        <h2 class="text-lg font-medium text-base-400">Profile Picture</h2>
        <p class="mt-1 text-sm text-base-200">Upload or change your profile picture.</p>
    </header>

    <form method="POST" action="{{ route('profile.edit') }}" enctype="multipart/form-data" class="mt-4 space-y-6">
        @csrf
        @method('patch')

        <div class="flex flex-wrap items-center gap-4">
            <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : 'https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.webp' }}" class="w-32 h-32 rounded-full object-cover" />
            <input type="file" name="profile_picture" accept="image/*" class="file-input file-input-bordered file-input-sm" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</section>