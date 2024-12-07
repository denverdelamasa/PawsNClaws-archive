<template>
  <div>
    <!-- Comments Modal -->
    <dialog ref="commentsDialog" class="modal">
      <div class="modal-box relative max-w-full w-9/12 h-screen p-8 scrollbar-hidden overflow-auto">
        <h3 class="text-xl font-bold my-4">Comments</h3>
        
        <!-- Comment Input -->
        <textarea 
            v-model="newComment" 
            placeholder="Write a comment..." 
            class="textarea textarea-bordered w-full resize-y" 
            rows="2">
        </textarea>
        <button @click="postComment" class="btn btn-primary mt-4 btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
            </svg>
            Post Comment
        </button>

        <!-- Comment Section -->
        <div class="comment-section mt-4">
          <!-- If there are comments, loop through them -->
          <div v-if="comments.length > 0">
            <div v-for="comment in comments" :key="comment.comment_id" class="mt-4 bg-base-300 p-4 rounded-r-xl rounded-b-xl my-4 relative">
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
                  <p class="text-sm font-semibold">{{ comment.user.username }}</p>
                  <div class="text-xs">
                    <span>Posted on: {{ comment.created_at }}</span>

                  </div>
                </div>
              </div>
              <p class="text-base transition-all duration-300">{{ comment.comment }}</p>
            </div>
          </div>

          <!-- If no comments, show a message -->
          <div v-else>
            <p>No comments yet. Be the first to comment!</p>
          </div>
        </div>

        <form method="dialog">
          <button @click="closeModal" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
      </div>
    </dialog>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'CommentsModal',
  props: ['isModalOpen', 'postId'],
  data() {
    return {
      comments: [],  // Array to store fetched comments
      newComment: '',
      isLoading: false,
    };
  },
  methods: {
    closeModal() {
      this.$emit('close'); // Emit the close event to the parent component
      this.$refs.commentsDialog.close(); // Close the dialog using its method
      this.comments = [];
    },
    fetchComments() {
        this.isLoading = true; // Set loading state to true when fetching comments
        axios.get(`/api/comments/post/${this.postId}`)
        .then(response => {
            this.comments = response.data;
            this.isLoading = false; // Set loading state to false when finished
        })
        .catch(error => {
            console.error("Error fetching comments:", error);
            this.isLoading = false; // Set loading state to false on error
        });
    },
    postComment() {
        if (!this.newComment.trim()) {
            alert("Comment cannot be empty!");
            return;
        }

        console.log("Post ID:", this.postId); // Debugging log
        axios.post('/api/comments/submit', {
            post_comment_id: this.postId,
            comment: this.newComment,
        })
            .then(response => {
                this.comments.push(response.data);
                this.newComment = '';
            })
            .catch(error => {
                console.error("Error posting comment:", error);
                alert("Could not post the comment. Please try again.");
            });
    },

  },
  watch: {
    isModalOpen(newVal) {
      if (newVal) {
        this.$refs.commentsDialog.showModal(); // Open the dialog when the prop is true
        this.fetchComments();  // Fetch comments when modal opens
      } else {
        this.$refs.commentsDialog.close(); // Close the modal when the prop is false
      }
    }
  }
};
</script>

<style scoped>
</style>
