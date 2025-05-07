<section x-data="profilePictureCropper()" x-cloak>
    <header>
        <h2 class="text-lg font-medium text-base-400">
            {{ __('Profile Picture') }}
        </h2>
        <p class="mt-1 text-sm text-base-200">
            {{ __("Update your account's profile picture.") }}
        </p>
    </header>

    <form method="POST" action="{{ route('client.profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6" @submit.prevent="submit">
        @csrf
        @method('patch')

        <!-- Current Profile Picture -->
        <div class="flex justify-center">
            <div class="profile-picture-wrapper">
                <img :src="previewUrl || '{{ Auth::user()->profile_picture ? Storage::url(Auth::user()->profile_picture) : asset('/images/defaultpics/defaultuserprofile.jpg') }}'"
                    alt="Profile Picture" class="profile-picture" />
            </div>
        </div>

        <!-- Hidden input to store cropped image -->
        <input type="hidden" name="cropped_image" x-ref="croppedImageInput" />

        <!-- File input -->
        <div>
            <x-input-label for="profile_picture" :value="__('Profile Picture')" />
            <input id="profile_picture" name="profile_picture" type="file" class="file-input file-input-bordered w-full"
                accept="image/*" @change="handleFileChange" />
            <x-input-error class="mt-2" :messages="$errors->get('profile_picture')" />
        </div>

        <!-- Modal crop preview -->
        <div x-show="showCropModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-base-200 rounded-lg p-4 shadow-md w-96">
                <div>
                    <img x-ref="imageCropper" class="max-w-full" />
                </div>
                <div class="mt-4 flex justify-end gap-2">
                    <button type="button" @click="cancelCrop" class="text-sm px-4 py-2 bg-gray-200 rounded">Cancel</button>
                    <button type="button" @click="cropImage" class="text-sm px-4 py-2 bg-blue-500 text-white rounded">Crop</button>
                </div>
            </div>
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
<script>
    function profilePictureCropper() {
        return {
            previewUrl: null,
            cropper: null,
            showCropModal: false,

            handleFileChange(event) {
                const file = event.target.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = (e) => {
                    this.previewUrl = e.target.result;
                    this.showCropModal = true;
                    this.$nextTick(() => {
                        const image = this.$refs.imageCropper;
                        image.src = this.previewUrl;
                        this.cropper = new Cropper(image, {
                            aspectRatio: 1,
                            viewMode: 1,
                            autoCropArea: 1,
                        });
                    });
                };
                reader.readAsDataURL(file);
            },

            cancelCrop() {
                this.showCropModal = false;
                this.cropper?.destroy();
                this.cropper = null;
                this.$refs.imageCropper.src = '';
            },

            cropImage() {
                if (!this.cropper) return;

                const canvas = this.cropper.getCroppedCanvas({
                    width: 300,
                    height: 300,
                });

                // Create a circular canvas
                const circleCanvas = document.createElement('canvas');
                const size = 300;
                circleCanvas.width = size;
                circleCanvas.height = size;

                const ctx = circleCanvas.getContext('2d');

                // Draw circular clipping path
                ctx.beginPath();
                ctx.arc(size / 2, size / 2, size / 2, 0, Math.PI * 2, true);
                ctx.closePath();
                ctx.clip();

                ctx.drawImage(canvas, 0, 0, size, size);

                circleCanvas.toBlob(blob => {
                    const reader = new FileReader();
                    reader.onloadend = () => {
                        this.$refs.croppedImageInput.value = reader.result;
                        this.previewUrl = reader.result;
                        this.showCropModal = false;
                        this.cropper.destroy();
                        this.cropper = null;
                    };
                    reader.readAsDataURL(blob);
                }, 'image/png');
            },

            submit() {
                this.$el.closest('form').submit(); // Let the form submit normally
            }
        }
    }
</script>
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
    .cropper-crop-box,
    .cropper-view-box {
        border-radius: 50% !important;
    }
</style>