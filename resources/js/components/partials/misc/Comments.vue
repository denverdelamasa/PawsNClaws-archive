<template>
  <div>
    <!-- Comments Modal -->
    <dialog ref="commentsDialog" class="modal">
      <div class="modal-box relative max-w-full w-9/12 h-screen p-8 scrollbar-hidden overflow-auto">
        <h3 class="text-xl font-bold my-4">{{ commentsCount }} {{ commentsCount === 1 ? 'Comment' : 'Comments' }}</h3>
        
        <!-- Comment Input -->
        <textarea v-model="newComment" placeholder="Write a comment..." class="textarea textarea-bordered w-full resize-y" rows="1"></textarea>
        <button @click="postComment" class="btn btn-primary mt-4 btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
            </svg>
            Post Comment
        </button>

        <!-- Comment Section -->
        <div class="comment-section mt-4">
          <!-- Loading Animation -->
          <div v-if="isLoading">
            <div class="relative flex w-64 animate-pulse gap-2 p-4">
              <div class="h-12 w-12 rounded-full bg-slate-400"></div>
              <div class="flex-1">
                <div class="mb-1 h-5 w-3/5 rounded-lg bg-slate-400 text-lg"></div>
                <div class="h-5 w-[100%] rounded-lg bg-slate-400 text-sm"></div>
              </div>
              <div class="absolute bottom-5 right-0 h-4 w-4 rounded-full bg-slate-400"></div>
            </div>
          </div>
          <!-- Comments List -->
          <div v-else>
            <!-- If there are comments, loop through them -->
            <div v-if="comments.length > 0">
              <div v-for="comment in comments" :key="comment.comment_id" class="mt-4 bg-base-300 p-4 rounded-r-xl rounded-b-xl my-4 relative text-xs">
                <!-- Dropdown Menu -->
                <div v-if="isAuthenticated" class="dropdown dropdown-end absolute right-4 top-4" >
                  <label tabindex="0" class="btn btn-sm btn-ghost" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                      <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
                    </svg>
                  </label>
                  <ul tabindex="0" class="dropdown-content menu shadow bg-base-300 rounded-box w-45 z-40">
                    <li v-if="comment.user_id === currentUserId">
                      <a href="#" @click.prevent="openEditCommentModal(comment)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                        </svg>
                        Edit Comment
                      </a>
                    </li>
                    <li v-if="comment.user_id === currentUserId">
                      <a href="#" @click.prevent="openDeleteCommentModal(comment.comment_id)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                        </svg>
                        Delete Comment
                      </a>
                    </li>
                    <li v-if="comment.user_id !== currentUserId">
                      <a href="#" @click.prevent="openReportModal(comment.comment_id)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-flag" viewBox="0 0 16 16">
                          <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21 21 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21 21 0 0 0 14 7.655V1.222z"/>
                        </svg>
                        Report Comment
                      </a>
                    </li>
                  </ul>
                </div>

                <!-- Delete Comment Modal -->
                <dialog :id="`deleteCommentModal-${comment.comment_id}`" class="modal">
                  <div class="modal-box">
                    <h3 class="text-lg font-bold">Are you sure you want to delete this comment?</h3>
                    <p class="py-4">This action cannot be undone.</p>
                    <div class="modal-action">
                      <button class="btn btn-error" @click="confirmDeleteComment(comment.comment_id)">Yes, Delete</button>
                      <button class="btn" @click="closeDeleteCommentModal(comment.comment_id)">Cancel</button>
                    </div>
                  </div>
                </dialog>

                <ReportComments v-if="selectedCommentId" :commentId="selectedCommentId" :reportType="'comment'" :currentUserId="currentUserId" @close="closeReportModal"/>

                <div class="flex items-center space-x-3">
                  <div class="avatar">
                    <div class="w-12 h-12 rounded-full">
                      <img :src="comment.user.profile_picture 
                                  ? `/storage/${comment.user.profile_picture}` 
                                  : 'https://picsum.photos/200'" 
                           alt="User Avatar" />
                    </div>
                  </div>
                  <div>
                    <p class="text-m font-semibold">{{ comment.user.name }}</p>
                    <span class="text-sm">{{ comment.user.username }}</span>
                    <div class="text-xs">
                      <span>Posted: {{ comment.created_at }}</span>
                    </div>
                  </div>
                </div>
                <!-- Edit Comment-->
                <div v-if="isEditing && selectedComment.comment_id === comment.comment_id">
                  <textarea 
                    v-model="selectedComment.comment" 
                    class="textarea textarea-bordered w-full"
                    @keyup.esc="cancelEdit"
                  ></textarea>
                  <button @click.prevent="saveEditedComment(comment.comment_id)" class="btn btn-primary mt-4 btn-sm">Save</button>
                  <p class="text-xs text-gray-500 mt-1">
                    Press ESC to
                    <button @click="cancelEdit" class="text-blue-500">cancel</button>
                  </p>
                  
                </div>
                <div v-else>
                  <p class="text-base transition-all duration-300">{{ comment.comment }}</p>
                </div>
              </div>
            </div>

            <!-- If no comments, show a message -->
            <div v-else>
              <p>No comments yet. Be the first to comment!</p>
            </div>
          </div>
        </div>

        <form method="dialog">
          <button @click="closeModal" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
      </div>
      <div v-if="noMoreComments && comments.length > 0" class="text-center py-4 text-gray-500">
        No more comments available.
      </div>
    </dialog>
  </div>
</template>


<script>
import axios from 'axios';
import Swal from 'sweetalert2';
import ReportComments from '../misc/Reports.vue';

export default {
  name: 'CommentsModal',
  components: {
    ReportComments
  },
  props: {
    isCommentsModalOpen: {
      type: Boolean,
      required: true
    },
    postId: {
      type: [String, Number],
      required: false
    },
    announcementId: {
      type: [String, Number],
      required: false
    },
    commentList: {
      type: Array,
      default: () => []
    }
  },
  emits: ['close'],
  data() {
    return {
      selectedComment: {},
      comments: [],  // Array to store fetched comments
      newComment: '',
      isLoading: false,
      loading: false,
      currentUserId: null,
      isAuthenticated: false,
      selectedCommentId: null,
      isEditing: false,
      reportReason: '',
      customReason: '',
      currentPage: 1, // Current page number
      totalPages: 1, // Total number of pages
      noMoreComments: false,
      commentsCount: 0,
    };
  },
  methods: {
    showModal(commentId) {
      if (modal) {
        modal.showModal();
      } else {
        console.log("Modal not found");
      }
    },
    openEditCommentModal(comment) {
      this.selectedComment = { ...comment };  // Copy comment data to selectedComment
      this.isEditing = true;  // Set editing state to true
    },
    saveEditedComment(commentId) {
      if (!this.selectedComment || !this.selectedComment.comment || !this.selectedComment.comment.trim()) {
        alert("Comment cannot be empty!");
        return;
      }

      axios.put(`/api/comments/edit/${commentId}`, {
        comment: this.selectedComment.comment
      })
      .then(response => {
        // Fetch the updated comments list
        this.fetchComments(); // Assuming fetchComments is a method to retrieve all comments

        this.isEditing = false; // Exit editing mode
        this.selectedComment = {}; // Clear the selected comment
      })
      .catch(error => {
        console.error("Error updating comment:", error);
      });
    },
    cancelEdit() {
      this.isEditing = false; // Exit editing mode
      this.selectedComment = {}; // Clear the selected comment
    },
    openDeleteCommentModal(commentId) {
      const modal = document.getElementById(`deleteCommentModal-${commentId}`);
      modal.showModal();
    },
    closeDeleteCommentModal(commentId) {
      const modal = document.getElementById(`deleteCommentModal-${commentId}`);
      modal.close();
    },
    confirmDeleteComment(commentId) {
      axios.delete(`/api/comments/delete/${commentId}`)
        .then(response => {
          this.closeDeleteCommentModal(commentId);
          this.fetchComments(commentId);
        })
        .catch(error => console.error("Error deleting comment:", error));
    },
    closeModal() {
      this.$emit('close'); // Emit the close event to the parent component
      this.$refs.commentsDialog.close(); // Close the dialog using its method
      this.comments = [];
    },
    async fetchComments() {
      if (this.isLoading || this.currentPage > this.totalPages) return;

      this.isLoading = true;

      let url = '';
      if (this.postId) {
          url = `/api/comments/${this.postId}/post?page=${this.currentPage}`;
      } else if (this.announcementId) {
          url = `/api/comments/${this.announcementId}/announcement?page=${this.currentPage}`;
      } else {
          console.error("No postId or announcementId provided");
          this.isLoading = false;
          return;
      }

      try {
          const response = await axios.get(url);
          const data = response.data;

          if (this.currentPage === 1) {
              this.comments = data.data;  // Reset comments on first page
              this.commentsCount = data.comments_count; // Store comments count
          } else {
              this.comments = [...this.comments, ...data.data];  // Append if paginating
          }

          this.currentPage++;
          this.totalPages = data.last_page;

          if (this.currentPage > this.totalPages) {
              this.noMoreComments = true;
          }
      } catch (error) {
          console.error("Error fetching comments:", error);
      } finally {
          this.isLoading = false;
      }
    },

    handleCommentsScroll() {
      const modal = this.$refs.commentsDialog;
      if (modal) {
        const bottomOfModal = modal.scrollTop + modal.clientHeight >= modal.scrollHeight - 100;
        console.log('Scroll event triggered', bottomOfModal, this.isLoading, this.noMoreComments);
        if (bottomOfModal && !this.isLoading && !this.noMoreComments) {
          this.fetchComments();
        }
      }
    },

    postComment() {
      if (!this.isAuthenticated) {
          Swal.fire({
              position: 'center',
              icon: 'warning',
              title: 'You need to log in to post a comment.',
              showConfirmButton: true,
              confirmButtonText: 'Log In',
              background: '#2c2f36',
              color: '#fff',
              confirmButtonColor: '#3085d6',
              toast: true,
              timer: 3000,
              timerProgressBar: true,
              customClass: {
                  container: 'swal2-container',
                  container: 'Comment_Toast'
              },
          }).then((result) => {
              if (result.isConfirmed) {
                  window.location.href = '/login';
              }
          });
          return;
      }

      if (!this.newComment.trim()) {
          alert("Comment cannot be empty!");
          return;
      }

      let commentData = {
          comment: this.newComment,
      };

      if (this.announcementId) {
          commentData.announcement_comment_id = this.announcementId;
      } else if (this.postId) {
          commentData.post_comment_id = this.postId;
      } else {
          console.error("No postId or announcementId provided");
          return;
      }

      axios.post('/api/comments/submit', commentData)
          .then(response => {
              this.comments.unshift(response.data);
              this.newComment = '';

              // Reset pagination and comments
              this.comments = [];
              this.currentPage = 1;
              this.noMoreComments = false;

              // Fetch fresh comments
              this.fetchComments();
          })
          .catch(error => {
              console.error("Error posting comment:", error);
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

    async checkAuthentication() {
      try {
          const response = await axios.get('/api/auth/status');
          this.isAuthenticated = response.data.authenticated;
          this.currentUserId = response.data.user_id; // Fetch the authenticated user's ID
      } catch (error) {
          console.error("Error checking authentication status:", error);
      }
    },
    handleEscKey(event) {
      if (event.key === 'Escape') {
        this.isEditing = false; // Exit edit mode
        this.selectedComment = {}; // Clear the selected comment
      }
    },
    
    openReportModal(commentId) {
      this.reportType = 'comment';
      this.selectedCommentId = commentId;
    },

    closeReportModal() {
      this.selectedCommentId = null;
    },
    openSuccessModal() {
      this.$refs.successModal.showModal(); // Open the success modal
    },

    closeSuccessModal() {
      this.$refs.successModal.close(); // Close the success modal
    },
    
  },
  watch: {
    isCommentsModalOpen(newVal) {
      if (newVal) {
        this.$refs.commentsDialog.showModal(); // Open the dialog when the prop is true
        this.fetchComments();  // Fetch comments when modal opens
        // Attach the scroll event listener when the modal opens
        const modal = this.$refs.commentsDialog;
        if (modal) {
          modal.addEventListener('scroll', this.handleCommentsScroll);
        }
      } else {
        this.$refs.commentsDialog.close(); // Close the modal when the prop is false
        // Remove the scroll event listener when the modal closes
        const modal = this.$refs.commentsDialog;
        if (modal) {
          modal.removeEventListener('scroll', this.handleCommentsScroll);
        }
      }
    }
  },
  mounted(){
    this.checkAuthentication();
    window.addEventListener('keydown', this.handleEscKey);
    
    const modal = this.$refs.commentsDialog;
    if (modal) {
      modal.addEventListener('scroll', this.handleCommentsScroll);
    }
  },
  beforeDestroy() {
    window.removeEventListener('keydown', this.handleEscKey); // Clean up the event listener
    
    const modal = this.$refs.commentsDialog;
    if (modal) {
      modal.removeEventListener('scroll', this.handleCommentsScroll);
    }
  }
};
</script>

<style scoped>
.swal2-container {
  z-index: 9999 !important;
}

.modal-box {
  overflow-y: auto;
  max-height: 80vh; /* Adjust as needed */
}
.modal-action {
  display: flex;
  justify-content: flex-end;
  margin-top: 20px;
}

.btn-primary {
  background-color: #3085d6;
  color: #fff;
  border: none;
  padding: 8px 16px;
  border-radius: 5px;
  cursor: pointer;
}

.btn-primary:hover {
  background-color: #1c6aa8;
} 
</style>

