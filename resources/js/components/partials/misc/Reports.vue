<template>
  <dialog ref="reportDialog" :id="`reportPostModal-${postId}`" class="modal">
    <div class="modal-box">
      <h3 class="text-lg font-bold">Report Post</h3>
      <p class="py-4">Please select the reason for reporting this post:</p>

      <form @submit.prevent="submitReport">
        <!-- Predefined Report Reasons -->
        <div class="my-4 gap-y-2 flex flex-col">
          <div>
            <input type="radio" id="troll" value="Troll" v-model="reportReason" class="radio"/>
            <label for="troll" class="ml-2">Troll</label>
          </div>

          <div>
            <input type="radio" id="hate-speech" value="Hate Speech" v-model="reportReason" class="radio"/>
            <label for="hate-speech" class="ml-2">Hate Speech</label>
          </div>

          <div>
            <input type="radio" id="spam" value="Spam" v-model="reportReason" class="radio"/>
            <label for="spam" class="ml-2">Spam</label>
          </div>

          <div>
            <input type="radio" id="harassment" value="Harassment" v-model="reportReason" class="radio"/>
            <label for="harassment" class="ml-2">Harassment</label>
          </div>

          <div>
            <input type="radio" id="other" value="Other" v-model="reportReason" class="radio"/>
            <label for="other" class="ml-2">Other</label>
          </div>
        </div>

        <!-- If "Other" is selected, show a text area for additional comments -->
        <div v-if="reportReason === 'Other'" class="my-4">
          <label for="custom-reason" class="label">Please describe the issue</label>
          <textarea
            id="custom-reason"
            v-model="customReason"
            class="textarea textarea-bordered w-full"
            rows="4"
            placeholder="Enter custom reason for reporting..."
          ></textarea>
        </div>

        <div class="modal-action">
          <button class="btn btn-error">Submit Report</button>
          <a class="btn" @click="closeModal">Cancel</a>
        </div>
      </form>
    </div>
  </dialog>
</template>

<script>
import axios from "axios";
import Swal from 'sweetalert2';

export default {
  props: {
    postId: {
      type: Number,
      required: true,
    },
    currentUserId: {
      type: Number,
      required: true,
    },
  },
  data() {
    return {
      reportReason: '',
      customReason: '',
    };
  },
  methods: {
    closeModal() {
      this.$refs.reportDialog.close();
      this.$emit('close');
      this.reportReason = ''; // Clear the selected reason
      this.customReason = ''; // Clear the custom reason field
    },
    submitReport() {
      const reportData = {
        user_id: this.currentUserId,  // The user reporting the post/comment
        reason: this.reportReason,
        type: 'post',
        post_id: this.postId,
        details: this.reportReason === 'Other' ? this.customReason : '',
      };

      axios.post('/api/reports/submit', reportData)
        .then(response => {
          this.closeModal();
          
          Swal.fire({
            position: 'center',  // Positions it in the center of the screen
            icon: 'success',  // You can change the icon to 'error', 'warning', etc.
            title: 'Your report has been submitted successfully!',  // Customize your message
            showConfirmButton: true,  // Show the OK button
            confirmButtonText: 'OK',  // Text of the button
            background: '#2c2f36',  // Dark background color
            color: '#fff',  // White text color
            confirmButtonColor: '#3085d6',  // Blue color for the button
            toast: true,  // Display as a toast
            timer: 3000,  // Time in milliseconds before the toast closes
            timerProgressBar: true,  // Optional, shows a progress bar
            didOpen: () => {
              Swal.showLoading();  // Show loading indicator
            }
          });
        })
        .catch(error => {
          console.error('Error submitting report:', error);
          
          Swal.fire({
          position: 'center',
          icon: 'error',
          title: 'Something went wrong!',
          text: error.response ? error.response.data.message : 'Try again later.',
          showConfirmButton: false,
          toast: true,
          timer: 3000,
          timerProgressBar: true,
          background: '#2c2f36',
          color: '#fff',
        });
        });
    },
  },
  mounted(){
    this.$refs.reportDialog.showModal();
  }
};
</script>

<style scoped>
/* Add any custom styles here */
</style>