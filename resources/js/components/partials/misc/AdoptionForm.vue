<template>
<dialog :open="isOpen" class="modal">
    <div class="modal-box h-auto max-w-6xl max-h-[80vh] hide-scrollbar">
      <form method="dialog">
        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" @click="$emit('close')">✕</button>
      </form>
      
      <h3 class="text-lg font-bold mb-4">Adoption Application</h3>
      
      <!-- Adoption Form -->
      <form @submit.prevent="submitForm">
        <!-- 1. Full Name -->
        <div class="mb-4">
          <label for="adopterName" class="block text-sm font-medium">Full Name</label>
          <p class="m-2 text-xs text-secondary">ex: Juan Dela Cruz </p>
          <input type="text" id="adopterName" v-model="formData.adopterName" name="adopterName" class="input input-bordered w-full" required>
        </div>

        <!-- 2. Contact Info -->
        <div class="mb-4">
          <label for="contactInfo" class="block text-sm font-medium">Contact Info</label>
          <p class="m-2 text-xs text-secondary">(Phone or Email)</p>
          <input type="text" id="contactInfo" v-model="formData.contactInfo" name="contactInfo" class="input input-bordered w-full" required>
        </div>

        <div class="flex flex-row justify-between gap-x-2">
          <!-- 3. Individual/Organization/Shelter -->
          <div class="mb-4 w-full">
            <label for="adoptType" class="block text-sm font-medium">Who Are You Representing?</label>
            <select id="adoptType" v-model="formData.adoptType" name="adoptType" class="select select-bordered w-full" required>
              <option value="individual">Individual</option>
              <option value="organization">Organization</option>
              <option value="shelter">Shelter</option>
            </select>
          </div>

          <!-- 9. Student/Employed/Volunteer -->
          <div class="mb-4 w-full">
            <label for="employmentStatus" class="block text-sm font-medium">Current Status</label>
            <select id="employmentStatus" v-model="formData.employmentStatus" name="employmentStatus" class="select select-bordered w-full" required>
              <option value="student">Student</option>
              <option value="employed">Employed</option>
              <option value="volunteer">Volunteer</option>
            </select>
          </div>
        </div>

        <!-- 4. Social Media Links -->
        <div class="mb-4">
          <label for="socmed" class="block text-sm font-medium">Social Media Links</label>
          <p class="m-2 text-xs text-secondary">(Optional)</p>
          <input
            type="url"
            id="socmed"
            v-model="formData.socmed"
            name="socmed"
            class="input input-bordered w-full"
            @input="validateSocmedLink"
            placeholder="Enter social media link (Facebook, Instagram, etc.)"
          >
          <p v-if="invalidSocmedLink" class="text-xs text-red-500 mt-1">Please enter a valid social media link (e.g., Facebook, Instagram, X).</p>
        </div>

        <!-- 5. Complete Location -->
        <div class="mb-4">
          <label for="location" class="block text-sm font-medium">Location</label>
          <p class="m-2 text-xs text-secondary">1234 Maple Street, Apartment 5B, Town, City</p>
          <input type="text" id="location" v-model="formData.location" name="location" class="input input-bordered w-full" required>
        </div>

        <!-- 6. Experience with Pets -->
        <div class="mb-4">
          <label for="experience" class="block text-sm font-medium">Experience with Pets</label>
          <p class="m-2 text-xs text-secondary">Any pets you have taken care of?</p>
          <textarea id="experience" v-model="formData.experience" name="experience" rows="4" class="textarea textarea-bordered w-full" required></textarea>
        </div>

        <!-- 7. Reason for Adopting -->
        <div class="mb-4">
          <label for="reason" class="block text-sm font-medium">Reason for Adopting</label>
          <textarea id="reason" name="reason" v-model="formData.reason" rows="6" class="textarea textarea-bordered w-full" required></textarea>
        </div>

        <!-- 8. Number of Current Pets -->
        <div class="mb-4">
          <label for="currentPets" class="block text-sm font-medium">Number of Current Pets</label>
          <input 
            type="number" 
            id="currentPets" 
            name="currentPets"
            v-model="formData.currentPets" 
            class="input input-bordered w-full" 
            min="0" 
            value="0" 
            required>
        </div>

        <!-- 9. Valid Gov. ID -->
        <div class="mb-4">
          <label for="govId" class="block text-sm font-medium">Valid Government ID (Upload)</label>
          <input type="file" id="gov_id" name="gov_id" @change="handleFileChange" class="file-input file-input-bordered w-full" accept=".jpg,.jpeg,.png,.pdf" required>
        </div>

        <!-- Submit Button -->
        <div class="mb-4 flex flex-col justify-center items-center">
          <button type="submit" class="btn btn-outline btn-warning btn-md flex items-center gap-2 m-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-paper-heart" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v1.133l.941.502A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765L2 3.133zm0 2.267-.47.25A1 1 0 0 0 1 5.4v.817l1 .6zm1 3.15 3.75 2.25L8 8.917l1.25.75L13 7.417V2a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1zm11-.6 1-.6V5.4a1 1 0 0 0-.53-.882L14 4.267zM8 2.982C9.664 1.309 13.825 4.236 8 8 2.175 4.236 6.336 1.31 8 2.982m7 4.401-4.778 2.867L15 13.117zm-.035 6.88L8 10.082l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738ZM1 13.116l4.778-2.867L1 7.383v5.734Z"/>
            </svg>
            <span>Submit Application</span>
          </button>
          <p class="m-2 text-xs text-secondary">
            By pressing submit button you are agreeing to our 
            <a href="#" class="underline">Terms of Service</a>.
          </p>
        </div>
      </form>
    </div>
    <!-- Adoption Confirmation Modal -->
    <dialog :open="isConfirmModalOpen" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Confirm Adoption Application</h3>
            <p class="py-4">Are you sure you want to submit your adoption application?</p>
            <div class="modal-action">
                <button class="btn btn-outline" @click="isConfirmModalOpen = false">Cancel</button>
                <button class="btn btn-warning" @click="confirmSubmit">Yes, Submit</button>
            </div>
        </div>
    </dialog>
</dialog>
</template>
<script>
export default {
  props: {
    isOpen: {
      type: Boolean,
      required: true,
    },
    postId: {
      type: [Number, String],
      required: true,
    },
    receiverUserId: {
      type: [Number, String],
      required: true,
    },
    currentUserId: {
      type: [Number, String],
      required: true,
    },
  },
  data() {
    return {
      formData: {
        adopterName: '',
        contactInfo: '',
        adoptType: '',
        employmentStatus: '',
        socmed: '',
        location: '',
        experience: '',
        reason: '',
        currentPets: 0,
        govIdFile: null,
      },
      invalidSocmedLink: false,
      isConfirmModalOpen: false,
    };
  },
  methods: {
    handleFileChange(event) {
      const file = event.target.files[0];
      this.formData.govIdFile = file || null;
    },
    validateSocmedLink() {
      const socmedPattern = /^(https?:\/\/)?(www\.)?(facebook|instagram|x|twitter|tiktok|linkedin)\.(com|co|io)\/[a-zA-Z0-9_.-]+(\/)?$/;
      if (this.formData.socmed && !socmedPattern.test(this.formData.socmed)) {
        this.invalidSocmedLink = true;
      } else {
        this.invalidSocmedLink = false;
      }
    },
    submitForm() {
      this.isConfirmModalOpen = true;
    },
    confirmSubmit() {
      this.isConfirmModalOpen = false;
      this.$emit('confirmForm', this.formData);
      this.resetForm();
    },
    resetForm() {
      this.formData = {
        adopterName: '',
        contactInfo: '',
        adoptType: '',
        employmentStatus: '',
        socmed: '',
        location: '',
        experience: '',
        reason: '',
        currentPets: 0,
        govIdFile: null,
      };
      this.invalidSocmedLink = false;
    },
  },
};
</script>
<style scoped>
.hide-scrollbar {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
.hide-scrollbar::-webkit-scrollbar {
  display: none;
}
</style>