<template>
  <!-- Success Modal -->
  <dialog ref="successDialog" class="modal">
    <LoginFirst v-if="showLoginModal" ref="loginFirst" @close="showLoginModal = false" />
    <div class="modal-box text-center p-8 transform transition-all duration-300">
      <div class="animate-scale-in">
        <!-- Animated checkmark -->
        <div class="flex justify-center mb-4">
          <svg class="w-16 h-16 text-green-400 animate-draw-check" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
          </svg>
        </div>

        <h3 class="text-2xl font-bold text-green-400 mb-2">Report Submitted!</h3>
        <p class="text-gray-300 mb-6">Thank you for helping improve our community 🌟</p>
        
        <div class="modal-action justify-center">
          <button 
            class="btn btn-success px-8 rounded-full transform transition-all hover:scale-105 hover:shadow-lg"
            @click="closeSuccessModal"
          >
            Got it!
          </button>
        </div>
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
  <dialog ref="reportDialog" class="modal">
    <div class="modal-box">
      <h3 class="text-lg font-bold text-red-600">
        Report
        {{ reportType === 'post' ? 'Post' :
          reportType === 'comment' ? 'Comment' :
          reportType === 'event' ? 'Event' :
          reportType === 'announcement' ? 'Announcement' : 'Content' }}
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
</template>

<script>
import axios from "axios";
import LoginFirst from "./LoginFirst.vue";
export default {
  props: {
    postId: {
      type: Number,
      default: null,
    },
    announcementId: {
      type: Number,
      default: null,
    },
    eventId: {
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
  components: {
    LoginFirst
  },
  data() {
    return {
      reportReason: '',
      customReason: '',
      errorMessage: '',
      showLoginModal: false,
    };
  },
  computed: {
    isComment() {
      return this.reportType === 'comment';
    }
  },
  methods: {
    triggerLoginModal() {
      this.showLoginModal = true;
      this.$nextTick(() => {
        const loginFirst = this.$refs.loginFirst;
        if (loginFirst) {
          loginFirst.showLoginModal();
        }
      });
    },
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
        announcement_id: this.reportType === 'announcement' ? this.announcementId : null,
        event_id: this.reportType === 'event' ? this.eventId : null,
        post_id: this.reportType === 'post' ? this.postId : null,
        type: this.reportType,
        comment_id: this.isComment ? this.commentId : null,
        details: this.reportReason === 'Other' ? this.customReason : '',
      };

      axios.post('/api/reports/submit', reportData)
        .then(() => {
          console.log('Showing success dialog...');
          this.reportReason = '';
          this.customReason = '';
          this.$refs.reportDialog.close();

          this.$refs.successDialog.showModal();
        })
        .catch(error => {
          console.error('Error submitting report:', error);
          this.errorMessage = error.response?.data?.message || 'Something went wrong. Please try again later.';
          this.closeModal();
          this.$refs.errorDialog.showModal();
        });
    },
    closeSuccessModal() {
      this.$refs.successDialog.close();
      this.$emit('close'); // Add this line
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
/* Animation for checkmark drawing */
@keyframes draw-check {
  from {
    stroke-dashoffset: 24;
  }
  to {
    stroke-dashoffset: 0;
  }
}

.animate-draw-check path {
  stroke-dasharray: 24;
  animation: draw-check 0.6s ease-out forwards;
}

/* Modal entrance animation */
.animate-scale-in {
  animation: scale-in 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
}

@keyframes scale-in {
  0% {
    transform: scale(0.5);
    opacity: 0;
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}

.modal-box {
  background: linear-gradient(145deg, #1a1e23, #2d333b);
  border-radius: 16px;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
}

.btn-success {
  background: #10b981;
  border-color: #059669;
  transition: all 0.2s ease;
}

.btn-success:hover {
  background: #059669;
  transform: translateY(-1px);
}
</style>