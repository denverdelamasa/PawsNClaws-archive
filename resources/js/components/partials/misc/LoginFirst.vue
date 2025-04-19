<template>
  <div class="p-6">
    <!-- Login Prompt Modal -->
    <dialog id="loginPromptModal" class="modal">
      <div class="modal-box">
        <h3 class="text-lg font-bold">Please Log In</h3>
        <p class="py-4">
          You need to be logged in to perform this action. Please log in or sign up
          to continue.
        </p>
        <div class="modal-action">
          <a href="/login" class="btn bg-primary text-base-300">Log In</a>
          <button class="btn btn-ghost" @click="closeModal">Cancel</button>
        </div>
      </div>
    </dialog>
  </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
  data() {
    return {
      isAuthenticated: false,
      currentUserId: null,
      loading: false,
    };
  },
  methods: {
    async checkAuthentication() {
      try {
        this.loading = true;
        const response = await axios.get('/api/auth/status');
        this.isAuthenticated = response.data.authenticated;
        this.currentUserId = response.data.user_id;
      } catch (error) {
        console.error('Error checking authentication status:', error);
        this.isAuthenticated = false;
      } finally {
        this.loading = false;
      }
    },
    handleInteraction() {
      if (!this.isAuthenticated) {
        this.showLoginModal();
      } else {
        this.performInteraction();
      }
    },
    showLoginModal() {
      const modal = document.getElementById('loginPromptModal');
      if (modal) {
        modal.showModal();
      }
    },
    closeModal() {
      const modal = document.getElementById('loginPromptModal');
      if (modal) {
        modal.close();
      }
    },
  },
  mounted() {
    this.checkAuthentication();
  },
};
</script>

<style scoped>
.modal-box {
  background-color: #1e293b;
  color: #ffffff;
  border: 1px solid #374151;
}
.btn-primary {
  background-color: #10b981;
  border-color: #10b981;
}
.btn-primary:hover {
  background-color: #059669;
  border-color: #059669;
}
.btn-ghost {
  color: #9ca3af;
}
.btn-ghost:hover {
  background-color: #374151;
}
</style>