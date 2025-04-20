<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @include('partials.main.data-theme')>
@include('partials.main.scripts-styles')    
<body class="font-sans">
    @include('partials.main.navbar')      
    <div id="app2">
        <div class="max-w-3xl mx-auto p-4 bg-base-200 m-4 rounded-md shadow-lg">
            <h1 class="text-3xl font-bold mb-6">Profile Settings</h1>

            <!-- Feedback Area -->
            <div id="feedback" class="hidden mb-4 p-4 rounded-md"></div>

            <!-- Profile Form -->
            <form id="profileForm" enctype="multipart/form-data">
                @csrf <!-- Include CSRF token for non-API authentication -->

                <!-- Profile Picture Upload -->
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2">Profile Picture</label>
                    <div class="flex flex-wrap items-center gap-4">
                        <img id="profileImage" src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : 'https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.webp' }}" class="w-32 h-32 rounded-full object-cover" />
                        <input type="file" name="profile_picture" class="file-input file-input-bordered file-input-sm" accept="image/*" />
                    </div>
                </div>

                <!-- Name -->
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Name</label>
                    <input type="text" name="name" class="input input-bordered w-full" placeholder="Your Name" value="{{ auth()->user()->name ?? '' }}" />
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Change Email</label>
                    <input type="email" name="email" class="input input-bordered w-full" placeholder="current@email.com" value="{{ auth()->user()->email ?? '' }}" />
                    <p class="text-xs text-gray-500 mt-1 italic">
                        We’ll send a confirmation OTP to this new email to verify it's really you. 📩
                    </p>
                </div>

                <!-- Bio -->
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Bio</label>
                    <textarea 
                        id="bio" 
                        name="bio" 
                        class="textarea textarea-bordered w-full resize-none overflow-hidden" 
                        rows="1" 
                        placeholder="Short description about you...">{{ auth()->user()->bio ?? '' }}</textarea>
                </div>

                <h1 class="text-3xl font-bold mb-6">Change Password</h1>
                <div class="my-4 py-4 border-y-2 border-base-300">
                    <!-- Current Password -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Current Password</label>
                        <input type="password" name="current_password" class="input input-bordered w-full" placeholder="Enter current password" />
                    </div>

                    <!-- New Password -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">New Password</label>
                        <input type="password" name="password" class="input input-bordered w-full" placeholder="Enter new password" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-1">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="input input-bordered w-full" placeholder="Confirm new password" />
                    </div>
                </div>

                <!-- Save Button -->
                <div class="mb-6">
                    <button type="submit" class="btn btn-primary w-full">Save Profile Changes</button>
                </div>
            </form>

            <!-- Danger Zone -->
            <div class="border-t border-base-300 pt-6">
                <h2 class="text-xl font-semibold text-red-500 mb-4">Delete your Account?</h2>
                <button class="btn btn-error w-full" onclick="warningModal.showModal()">Delete My Account</button>
            </div>

            <!-- Warning Modal -->
            <dialog id="warningModal" class="modal">
                <div class="modal-box">
                    <h3 class="font-bold text-lg text-warning">⚠️ Warning</h3>
                    <p class="py-4">You're about to delete your account. This action is irreversible and your data will be gone forever 😬</p>
                    <div class="modal-action">
                        <form method="dialog" class="space-x-2">
                            <button class="btn">Cancel</button>
                            <button class="btn btn-error" onclick="confirmModal.showModal()">Continue</button>
                        </form>
                    </div>
                </div>
            </dialog>

            <!-- Final Confirmation Modal -->
            <dialog id="confirmModal" class="modal">
                <div class="modal-box">
                    <h3 class="font-bold text-lg text-error">🔥 Final Confirmation</h3>
                    <p class="py-4">Are you ABSOLUTELY sure you want to delete your account? There’s no going back after this 😭</p>
                    <div class="modal-action">
                        <form method="dialog" class="space-x-2">
                            <button class="btn">Go Back</button>
                            <button class="btn btn-error" id="deleteAccountBtn">Yes, Delete My Account</button>
                        </form>
                    </div>
                </div>
            </dialog>
        </div>
    </div>

    <style>
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
            overflow: auto;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const textarea = document.querySelector('#bio');
            const profileForm = document.querySelector('#profileForm');
            const feedback = document.querySelector('#feedback');
            const profileImage = document.querySelector('#profileImage');
            const deleteAccountBtn = document.querySelector('#deleteAccountBtn');

            // Auto-resize textarea
            const autoResize = (el) => {
                el.style.height = 'auto';
                el.style.height = el.scrollHeight + 'px';
            };
            textarea.addEventListener('input', () => autoResize(textarea));
            autoResize(textarea);

            // Form submission
            profileForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                feedback.classList.add('hidden');

                const formData = new FormData(profileForm);

                try {
                    const response = await fetch('/api/user/update/profile', {
                        method: 'PUT',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            'Accept': 'application/json',
                        },
                    });

                    const result = await response.json();

                    if (response.ok) {
                        feedback.classList.remove('hidden', 'alert-error');
                        feedback.classList.add('alert-success');
                        feedback.innerHTML = result.message;

                        // Update profile picture if changed
                        if (result.profile_picture) {
                            profileImage.src = result.profile_picture;
                        }
                    } else {
                        throw new Error(result.message || 'Failed to update profile');
                    }
                } catch (error) {
                    feedback.classList.remove('hidden', 'alert-success');
                    feedback.classList.add('alert-error');
                    feedback.innerHTML = error.message;
                }
            });

            // Delete account
            deleteAccountBtn.addEventListener('click', async () => {
                try {
                    const response = await fetch('/api/user/delete', {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            'Accept': 'application/json',
                        },
                    });

                    const result = await response.json();

                    if (response.ok) {
                        window.location.href = '/'; // Redirect to homepage or login page
                    } else {
                        throw new Error(result.message || 'Failed to delete account');
                    }
                } catch (error) {
                    feedback.classList.remove('hidden', 'alert-success');
                    feedback.classList.add('alert-error');
                    feedback.innerHTML = error.message;
                }
            });
        });
    </script>
</body>
</html>