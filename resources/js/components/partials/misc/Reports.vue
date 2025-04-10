<template>
  <dialog ref="reportDialog" class="modal">
    <div class="modal-box">
      <h3 class="text-lg font-bold text-red-600">
        Report {{ reportType === 'post' ? 'Post' : 'Comment' }}
      </h3>
      <p class="py-4 text-gray-300">Please select the reason for reporting this {{ reportType }}:</p>

      <form @submit.prevent="submitReport">
        <!-- Report Reasons -->
        <div class="my-4 gap-y-2 flex flex-col">
          <label class="inline-flex items-center">
            <input type="radio" value="Troll" v-model="reportReason" class="radio mr-2" /> Troll
          </label>
          <label class="inline-flex items-center">
            <input type="radio" value="Hate Speech" v-model="reportReason" class="radio mr-2" /> Hate Speech
          </label>
          <label class="inline-flex items-center">
            <input type="radio" value="Spam" v-model="reportReason" class="radio mr-2" /> Spam
          </label>
          <label class="inline-flex items-center">
            <input type="radio" value="Harassment" v-model="reportReason" class="radio mr-2" /> Harassment
          </label>
          <label class="inline-flex items-center">
            <input type="radio" value="Other" v-model="reportReason" class="radio mr-2" /> Other
          </label>
        </div>

        <div v-if="reportReason === 'Other'" class="my-4">
          <label for="custom-reason" class="label text-gray-300">Please describe the issue</label>
          <textarea
            id="custom-reason"
            v-model="customReason"
            class="textarea textarea-bordered w-full bg-gray-800 text-white"
            rows="4"
            placeholder="Enter custom reason for reporting..."
          ></textarea>
        </div>

        <div class="modal-action">
          <button type="submit" class="btn btn-error">Submit Report</button>
          <button type="button" class="btn" @click="closeModal">Cancel</button>
        </div>
      </form>
    </div>
  </dialog>

  <!-- Success Modal -->
  <dialog ref="successDialog" >
    <div class="modal-box text-center">
      <h3 class="text-lg font-bold text-green-400">Report Submitted</h3>
      <p class="py-4 text-gray-300">Your report has been submitted successfully!</p>
      <div class="modal-action justify-center">
        <button class="btn btn-success" @click="closeSuccessModal">OK</button>
      </div>
    </div>
  </dialog>

  <!-- Error Modal -->
  <dialog ref="errorDialog" class="modal">
    <div class="modal-box text-center">
      <h3 class="text-lg font-bold text-red-400">Submission Failed</h3>
      <p class="py-4 text-gray-300">{{ errorMessage }}</p>
      <div class="modal-action justify-center">
        <button class="btn btn-error" @click="closeErrorModal">Close</button>
      </div>
    </div>
  </dialog>
</template>

<script>
import axios from "axios";

export default {
  props: {
    postId: {
      type: Number,
      default: null,
    },
    commentId: {
      type: Number,
      default: null,
    },
    reportType: {
      type: String,
      required: true, // 'post' or 'comment'
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
      errorMessage: '',
    };
  },
  computed: {
    isComment() {
      return this.reportType === 'comment';
    }
  },
  methods: {
    closeModal() {
      this.$refs.reportDialog.close();
      this.$emit('close');
      this.reportReason = '';
      this.customReason = '';
      this.errorMessage = '';
    },
    closeSuccessModal() {
      this.$refs.successDialog.close();
    },
    closeErrorModal() {
      this.$refs.errorDialog.close();
    },
    submitReport() {
      const reportData = {
        user_id: this.currentUserId,
        reason: this.reportReason,
        type: this.reportType,
        post_id: this.isComment ? null : this.postId,
        comment_id: this.isComment ? this.commentId : null,
        details: this.reportReason === 'Other' ? this.customReason : '',
      };

      axios.post('/api/reports/submit', reportData)
        .then(() => {
          console.log('Showing success dialog...');
          this.closeModal();
          this.$nextTick(() => {
            this.$refs.successDialog.showModal();
          });
        })
        .catch(error => {
          console.error('Error submitting report:', error);
          this.errorMessage = error.response?.data?.message || 'Something went wrong. Please try again later.';
          this.closeModal();
          this.$refs.errorDialog.showModal();
        });
    },
  },
  mounted(){
    this.$refs.reportDialog.showModal();
  }
};
</script>

<style scoped>
.modal-box {
  background-color: #2c2f36;
  color: #fff;
  border-radius: 0.5rem;
}
.radio:checked {
  border-color: #dc2626;
  background-color: #dc2626;
}
</style>