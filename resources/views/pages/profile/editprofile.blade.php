<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @include('partials.main.data-theme')>
@include('partials.main.scripts-styles')    
    <body class="font-sans">
        @include('partials.main.navbar')      
        <div id="app2">

            <div class="max-w-3xl mx-auto p-4 bg-base-200 m-4 rounded-md shadow-lg">
                <h1 class="text-3xl font-bold mb-6">Profile Settings</h1>
            
                {{-- Profile Picture Upload --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2">Profile Picture</label>
                    <div class="flex flex-wrap items-center gap-4">
                        <img src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.webp" class="w-32 h-32 rounded-full object-cover" />
                        <input type="file" class="file-input file-input-bordered file-input-sm" />
                    </div>
                </div>
            
                {{-- Name --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Name</label>
                    <input type="text" class="input input-bordered w-full" placeholder="Your Name" />
                </div>
            
                {{-- Email --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Change Email</label>
                    <input type="email" class="input input-bordered w-full" placeholder="current@email.com" />
                    <p class="text-xs text-gray-500 mt-1 italic">
                        We’ll send a confirmation OTP to this new email to verify it's really you. 📩
                    </p>
                </div>
            
                {{-- Bio --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Bio</label>
                    <textarea 
                        id="bio" 
                        class="textarea textarea-bordered w-full resize-none overflow-hidden" 
                        rows="1" 
                        placeholder="Short description about you..."></textarea>
                </div>

                <h1 class="text-3xl font-bold mb-6">Change Password</h1>
                <div class="my-4 py-4 border-y-2 border-base-300">
                    {{-- Password --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">New Password</label>
                        <input type="password" class="input input-bordered w-full" placeholder="Enter new password" />
                    </div>

                    {{-- Confirm Password --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-1">Confirm Password</label>
                        <input type="password" class="input input-bordered w-full" placeholder="Confirm new password" />
                    </div>
                </div>
            
                {{-- Save Button --}}
                <div class="mb-6">
                    <label for="otp-modal" class="btn btn-primary w-full cursor-pointer">Save Profile Changes</label>
                </div>
                <!-- OTP Verification Modal -->
                <input type="checkbox" id="otp-modal" class="modal-toggle" />
                <div class="modal">
                <div class="modal-box">
                    <h3 class="font-bold text-lg mb-2">Verify Your Email</h3>
                    <p class="mb-4 text-sm">
                    We’ve sent a 6-digit verification code to your new email address. Please enter the code below to confirm your changes. 📩
                    </p>

                    <input
                    type="text"
                    maxlength="6"
                    placeholder="Enter OTP"
                    class="input input-bordered w-full mb-4 text-center tracking-widest font-mono text-lg"
                    />

                    <div class="modal-action">
                    <label for="otp-modal" class="btn btn-primary">Confirm</label>
                    <label for="otp-modal" class="btn">Cancel</label>
                    </div>
                </div>
                </div>
            
                {{-- Danger Zone --}}
                <div class="border-t border-base-300 pt-6">
                    <h2 class="text-xl font-semibold text-red-500 mb-4">Delete your Account?</h2>
                    
                    <!-- Trigger Button -->
                    <button class="btn btn-error w-full" onclick="warningModal.showModal()">Delete My Account</button>
                </div>
                <!-- First Modal: Warning -->
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

                <!-- Second Modal: Final Confirmation -->
                <dialog id="confirmModal" class="modal">
                    <div class="modal-box">
                        <h3 class="font-bold text-lg text-error">🔥 Final Confirmation</h3>
                        <p class="py-4">Are you ABSOLUTELY sure you want to delete your account? There’s no going back after this 😭</p>
                        <div class="modal-action">
                            <form method="dialog" class="space-x-2">
                                <button class="btn">Go Back</button>
                                <button class="btn btn-error">Yes, Delete My Account</button>
                            </form>
                        </div>
                    </div>
                </dialog>
            </div>

        </div>

    </body>
</html>

<style>
  /* Hide the scrollbar but allow scrolling */
  .hide-scrollbar::-webkit-scrollbar {
  display: none; /* Hides scrollbar in WebKit browsers */
  }

  .hide-scrollbar {
  -ms-overflow-style: none; /* Hides scrollbar in IE and Edge */
  scrollbar-width: none; /* Hides scrollbar in Firefox */
  overflow: auto; /* Ensure scrolling is enabled */
  }
</style>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const textarea = document.querySelector('#bio');

        const autoResize = (el) => {
            el.style.height = 'auto'; // reset height
            el.style.height = el.scrollHeight + 'px'; // then match scrollHeight
        }

        textarea.addEventListener('input', () => autoResize(textarea));
        
        // Trigger resize on load in case it has pre-filled text
        autoResize(textarea);
    });
</script>