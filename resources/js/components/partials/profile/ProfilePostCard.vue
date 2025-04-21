<template>
  <div v-for="post in posts" :key="post.post_id" class="card bg-base-200 w-full shadow-xl my-4 border border-base-300">
    <!-- Header with Title and Menu -->
    <div class="flex justify-end items-end p-4 gap-x-2">
      <!-- Show "Open for Adoption" when is_adoptable is 1 -->
      <div v-if="post.is_adoptable === 1" class="badge badge-warning badge-outline gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-heart" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M5 1.5A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5v1A1.5 1.5 0 0 1 9.5 4h-3A1.5 1.5 0 0 1 5 2.5zm5 0a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5z"/>
          <path d="M3 1.5h1v1H3a1 1 0 0 0-1 1V14a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V3.5a1 1 0 0 0-1-1h-1v-1h1a2 2 0 0 1 2 2V14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3.5a2 2 0 0 1 2-2"/>
          <path d="M8 6.982C9.664 5.309 13.825 8.236 8 12 2.175 8.236 6.336 5.31 8 6.982"/>
        </svg>
        Open for Adoption
      </div>

      <!-- Show "Adopted" when is_adoptable is 3 -->
      <div v-else-if="post.is_adoptable === 2" class="badge badge-info badge-outline gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-heart-fill" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
          <path fill-rule="evenodd" d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5zm4 5.982c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.69 0-5.018"/>
        </svg>
        Adopted
      </div>

      <!-- Hide both if is_adoptable is null or not set -->
      <div v-else class="badge badge-hidden"></div>
      <!-- Dropdown Menu -->
      <div class="dropdown dropdown-end ">
        <label tabindex="0" class="btn btn-sm btn-ghost">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3" />
            </svg>
        </label>
        <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-300 rounded-box w-40">
            <li v-if="post.user_id === currentUserId">
            <a href="#" @click.prevent="editPost(post)">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                </svg>
                Edit Post
            </a>
            </li>
            <li v-if="post.user_id === currentUserId">
                <a href="#" @click.prevent="openDeleteModal(post.post_id)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                    </svg>
                    Delete Post
                </a>
            </li>
        </ul>
      </div>
    </div>

    <!-- Thumbnail -->
    <div v-if="post.image_path && post.image_path.length > 0" 
        class="relative px-4 hover:cursor-pointer" 
        @click="showModal(post.post_id)">
      
      <!-- Image Display -->
      <div class="w-full h-[300px] sm:h-[250px] md:h-[280px] lg:h-[300px] overflow-hidden rounded">
        <img :src="`/storage/${Array.isArray(post.image_path) ? post.image_path[0] : post.image_path}`" 
            alt="Thumbnail" 
            class="w-full h-full object-cover transition-transform duration-300 ease-in-out hover:scale-110" />
      </div>

      <!-- Overlay for Multiple Images -->
      <div v-if="Array.isArray(post.image_path) && post.image_path.length > 1" 
          class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center rounded">
        <span class="text-white text-lg font-semibold">+{{ post.image_path.length - 1 }}</span>
      </div>
    </div>

    <!-- Edit Post Modal -->
    <dialog :id="`editPostModal-${post.post_id}`" class="modal">
        <div class="modal-box w-[90vw] h-[40vh] max-w-2xl">
          <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" @click="closeEditModal(post.post_id)">✕</button>
          <h3 class="text-xl font-semibold">Edit Post</h3>
          <form @submit.prevent="submitEditPost(post.post_id)">
            <div class="my-4">
              <label for="caption" class="label">Caption</label>
              <textarea v-model="selectedPost.caption" id="caption" class="textarea textarea-bordered w-full" rows="4"></textarea>
            </div>
            <div class="modal-action">
              <button class="btn btn-primary">Save Changes</button>
            </div>
          </form>
        </div>
    </dialog>
    <!-- Delete Confirmation Modal -->
    <dialog :id="`deletePostModal-${post.post_id}`" class="modal">
        <div class="modal-box">
            <h3 class="text-lg f-bold">Are you sure you want to delete this post?</h3>
            <p class="py-4">This action cannot be undone.</p>
            <div class="modal-action">
                <button class="btn btn-error" @click="confirmDelete(post.post_id)">Yes, Delete</button>
                <button class="btn" @click="closeDeleteModal(post.post_id)">Cancel</button>
            </div>
        </div>
    </dialog>

    <!-- Modal Thumbnail -->
    <dialog v-if="post.image_path" :id="'thumbnailModal-' + post.post_id" class="modal">
      <div class="modal-box w-[40vw] h-[40vh] max-w-7xl max-h-screen relative">
        <!-- Close Button -->
        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" @click="closeThumbnailModal(post.post_id)">✕</button>

        <!-- Image Carousel -->
        <div class="flex justify-center items-center h-full relative">
          <!-- Left Arrow (Only show if NOT on the first image) -->
          <button 
            v-if="post.image_path.length > 1 && currentIndex[post.post_id] > 0"
            class="absolute left-4 text-white text-2xl bg-black bg-opacity-50 p-2 rounded-full"
            @click="prevImage(post.post_id)"
          >
            &lt;
          </button>

          <!-- Image Display -->
          <img :src="`/storage/${post.image_path[currentIndex[post.post_id]]}`" alt="Thumbnail" class="max-w-full max-h-full rounded object-cover" />

          <!-- Right Arrow (Only show if NOT on the last image) -->
          <button 
            v-if="post.image_path.length > 1 && currentIndex[post.post_id] < post.image_path.length - 1"
            class="absolute right-4 text-white text-2xl bg-black bg-opacity-50 p-2 rounded-full"
            @click="nextImage(post.post_id)"
          >
            &gt;
          </button>
        </div>
      </div>
    </dialog>

    <!-- Card Body -->
    <div class="card-body">
      <div class="flex items-center space-x-3">
        <div class="avatar">
          <div class="w-12 h-12 rounded-full">
            <img :src="`/storage/${post.profile_picture}`" alt="User Avatar" />
          </div>
        </div>
        <div>
          <p class="text-sm font-semibold font-medium">{{ post.name }}</p>
          <div class="text-xs">
            <span class="font-small">{{ post.username }}</span>
            <br>
            <span>Posted: {{ post.created_at }}</span>
            <span class="mx-1">|</span>
            <span>Edited on: {{ post.updated_at }}</span>
          </div>
        </div>
      </div>
      <div class="text-base mt-2 w-full">
        <p class="break-words whitespace-normal text-sm sm:text-base">
          {{ post.expanded ? post.caption : (post.caption && post.caption.length > 135 ? post.caption.substring(0, 135) + '...' : post.caption) }}
        </p>
        <button 
          v-if="post.caption && post.caption.length > 125" 
          class="btn btn-link btn-xs text-sm mt-2"
          @click="toggleDescription(post)"
        >
          {{ post.expanded ? 'See Less' : 'See More' }}
        </button>
      </div>
    <div class="flex gap-2 flex-wrap">
      <!-- Upvote Button -->
      <button 
        class="btn bg-primary btn-sm text-base-300" 
        @click="likePost(post.post_id)">
        <svg
            v-if="post.is_liked"
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6"
            fill="currentColor"
            viewBox="0 0 24 24"
            stroke="currentColor">
            <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
        </svg>
        <svg
            v-else
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor">
            <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
        </svg>
        <p>{{ post.likes_count }} Like</p>
        </button>

      <!-- Comments Button -->
      <button class="btn btn-outline btn-sm flex gap-1 items-center" @click="openCommentsModal(post.post_id)">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-5 w-5 stroke-current">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8H7M17 12H7M9 16H15M5 5V19L10 14H19C19.5523 14 20 13.5523 20 13V6C20 5.44772 19.5523 5 19 5H5Z" />
      </svg>
      <span>{{ post.comments_count}} Comments</span>
    </button>

    <Comments :isCommentsModalOpen="isCommentsModalOpen" :commentList="comments" @close="closeCommentsModal" :postId="selectedCommentPostId"/>

      <!-- Bookmark Button -->
      <button @click="isBookmarked(post.post_id)" id="bookmarkBtn" class="btn btn-outline btn-sm flex items-center gap-2">
        <svg v-if="post.is_bookmarked" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmarks-fill" viewBox="0 0 16 16">
          <path d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5z"/>
          <path d="M4.268 1A2 2 0 0 1 6 0h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L13 13.768V2a1 1 0 0 0-1-1z"/>
        </svg>
        <svg v-else xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmarks" viewBox="0 0 16 16">
          <path d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v10.566l3.723-2.482a.5.5 0 0 1 .554 0L11 14.566V4a1 1 0 0 0-1-1z"/>
          <path d="M4.268 1H12a1 1 0 0 1 1 1v11.768l.223.148A.5.5 0 0 0 14 13.5V2a2 2 0 0 0-2-2H6a2 2 0 0 0-1.732 1"/>
        </svg>
        <span id="bookmarkText">Add to bookmarks</span>
      </button>
    </div>
    </div>
  </div>
  <!-- Add loading indicator -->
  <div v-if="loading" class="text-center my-4">
    <span class="loading loading-dots loading-lg"></span>
  </div>
  <div v-else-if="!hasMorePosts" class="text-center my-4">
    No more posts to load
  </div>
</template>
<script>
import axios from "axios";
import Swal from 'sweetalert2';
import Comments from '../misc/Comments.vue';

export default {
  components: {
    Comments
  },
  data() {
    return {
      posts: [],
      currentIndex: {},
      expanded: false,
      isAuthenticated: false,
      currentUserId: null,
      selectedPost: { caption: '' },
      isModalOpen: false,
      isCommentsModalOpen: false,
      comments: [],
      selectedCommentPostId: null,
      currentPage: 1,
      hasMorePosts: true,
      loading: false,
      scrollListener: null,
    };
  },
  methods: {
    async isBookmarked(postId) {
      if (!this.isAuthenticated) {
        this.triggerLoginModal();
        return;
      }
      
      try {
        await axios.post(`/api/bookmark/${postId}/post`);
        
        // Find the post and update its like state
        const post = this.posts.find(post => post.post_id === postId);
        if (post) {
          post.is_bookmarked = !post.is_bookmarked; // Toggle like state
        }

        // Fetch the updated likes count
        await this.UpdatePosts();
      } catch (error) {
        console.error("Error liking/unliking post:", error);
      }
    },
    UpdatePosts() {
      this.loading = true; // Show loader when starting request

      axios.get('/api/user/posts/list')
        .then(response => {
          const newPosts = response.data.posts || [];

          // Replace the posts list with the new posts
          this.posts = newPosts;

          // Optionally reset pagination info if you're still tracking it
          this.totalPages = 1;
          this.currentPage = 1;
          this.hasMore = false;
        })
        .catch(error => {
          console.error('Error fetching browse posts:', error);
        })
        .finally(() => {
          this.loading = false; // Hide loader when done
        });
    },
    openCommentsModal(postId) {
      this.isCommentsModalOpen = true;
      this.selectedCommentPostId = postId;
    },
    closeCommentsModal() {
      this.isCommentsModalOpen = false;
      this.comments = [];  // Clear comments when modal is closed
      this.UpdatePosts();
    },
    nextImage(postId) {
      const post = this.posts.find(post => post.post_id === postId);
      if (post && post.image_path.length > 0) {
        this.currentIndex[postId] = (this.currentIndex[postId] + 1) % post.image_path.length;
      } else {
        console.error("Post or image path not found for postId:", postId);
      }
    },
    prevImage(postId) {
      const post = this.posts.find(post => post.post_id === postId);
      if (post && post.image_path.length > 0) {
        this.currentIndex[postId] = (this.currentIndex[postId] - 1 + post.image_path.length) % post.image_path.length;
      } else {
        console.error("Post or image path not found for postId:", postId);
      }
    },
    openDeleteModal(postId) {
      const modal = document.getElementById(`deletePostModal-${postId}`);
      if (modal) {
        modal.showModal();
      }
    },
    closeDeleteModal(postId) {
      const modal = document.getElementById(`deletePostModal-${postId}`);
      if (modal) {
        modal.close();
      }
    },
    confirmDelete(postId) {
      axios.delete(`/api/posts/delete/${postId}`)
        .then(response => {
          this.UpdatePosts();
          console.log("Post deleted successfully");
          this.closeDeleteModal(postId);

            Swal.fire({
              position: "bottom-end",
              icon: "success",
              title: "Your post has been deleted successfully!",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              background: "#1e293b", // Dark background
              color: "#ffffff", // Light text color
              toast: true, // Toast-style alert
              didOpen: (toast) => {
                const progressBar = Swal.getTimerProgressBar();
                if (progressBar) {
                  progressBar.style.backgroundColor = "#ffffff"; // Customize progress bar color if needed
                }
              },
            });
          })
          .catch(error => {
            console.error("Error deleting post:", error);

            Swal.fire({
              icon: "error",
              title: "Oops...",
              showConfirmButton: false,
              text: "Something went wrong while uploading your post!",
              background: "#1e293b", // Dark background
              color: "#ffffff", // Light text color
              toast: true,
              });
          });
      },
      editPost(post) {
          this.selectedPost = { ...post };     // Make sure to copy post data correctly
          const modal = document.getElementById(`editPostModal-${post.post_id}`);
          if (modal) {
              modal.showModal();
          }
      },

      // Close the edit modal
      closeEditModal(postId) {
          const modal = document.getElementById(`editPostModal-${postId}`);
          if (modal) {
              modal.close();  // This will close the modal
          }
      },

    // Submit the edit form
    submitEditPost() {
      axios.put(`/api/post/edit/${this.selectedPost.post_id}`, this.selectedPost, {
        })
        .then(response => {
            this.UpdatePosts();
            this.closeEditModal(this.selectedPost.post_id);  // Close the modal after success
            
            Swal.fire({
                position: "bottom-end",
                icon: "success",
                title: "Your post has been updated successfully!",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: "#1e293b", // Dark background
                color: "#ffffff", // Light text color
                toast: true, // Toast-style alert
                didOpen: (toast) => {
                const progressBar = Swal.getTimerProgressBar();
                if (progressBar) {
                    progressBar.style.backgroundColor = "#ffffff"; // Customize progress bar color if needed
                }
                },
            });
        })
        .catch(error => {
            if (error.response && error.response.status === 422) {
            this.errors = error.response.data.errors;
            let errorMessages = '';
            for (let key in this.errors) {
                errorMessages += `${this.errors[key].join(', ')}\n`;
            }

            // Optionally, you can display the errors using a custom method
            console.error('Validation Failed:', errorMessages.trim());
            } else {
            console.error('Error updating post:', error);
            }
            Swal.fire({
                position: "bottom-end",
                icon: "success",
                title: "Something went wrong",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: "#1e293b", // Dark background
                color: "#ffffff", // Light text color
                toast: true, // Toast-style alert
                didOpen: (toast) => {
                const progressBar = Swal.getTimerProgressBar();
                if (progressBar) {
                    progressBar.style.backgroundColor = "#ffffff"; // Customize progress bar color if needed
                }
                },
            });
        });
    },
    toggleDescription(post) {
      post.expanded = !post.expanded;
    },
    showModal(postId) {
      // Ensure the index is set to 0 if undefined
      if (!(postId in this.currentIndex)) {
        this.currentIndex[postId] = 0;
      }

      const modal = document.getElementById(`thumbnailModal-${postId}`);
      if (modal) {
      modal.showModal();
      }
    },
    closeThumbnailModal(postId) {
        const modal = document.getElementById(`thumbnailModal-${postId}`);
        if (modal) {
        modal.close();
        }
    },
    async fetchPosts(initialLoad = false) {
      if (this.loading || !this.hasMorePosts) return;
      
      this.loading = true;
      try {
        const response = await axios.get(`/api/user/posts/list?page=${this.currentPage}`);
        
        if (initialLoad) {
          this.posts = response.data.posts;
        } else {
          this.posts = [...this.posts, ...response.data.posts];
        }

        this.hasMorePosts = !!response.data.pagination.next_page_url;
        this.currentPage++;
      } catch (error) {
        console.error("Error fetching posts:", error);
      } finally {
        this.loading = false;
      }
    },
    handleScroll() {
      const scrollY = window.scrollY || window.pageYOffset;
      const visibleHeight = window.innerHeight;
      const pageHeight = document.documentElement.scrollHeight;
      const bottomOffset = 100; // Load more when 100px from bottom

      if (pageHeight - (scrollY + visibleHeight) < bottomOffset) {
        if (!this.loading && this.hasMorePosts) {
          this.fetchPosts();
        }
      }
    },
    async likePost(postId) {
      try {
        await axios.post(`/api/like/${postId}/post`);
        
        // Find the post and update its like state
        const post = this.posts.find(post => post.post_id === postId);
        if (post) {
          post.is_liked = !post.is_liked; // Toggle like state
        }

        // Fetch the updated likes count
        await this.fetchLikesCount(postId);
      } catch (error) {
        console.error("Error liking/unliking post:", error);
      }
    },
    async fetchLikesCount(postId) {
      try {
        const response = await axios.get(`/api/like-count/${postId}/post`);
        const post = this.posts.find(post => post.post_id === postId);
        if (post) {
          post.likes_count = response.data.likesCount; // Update only post likes count
        }
      } catch (error) {
        console.error("Error fetching likes count:", error);
      }
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
  },
  mounted() {
    this.checkAuthentication();
    this.fetchPosts(true);
    this.scrollListener = this.handleScroll.bind(this);
    window.addEventListener('scroll', this.scrollListener);
  },
  beforeUnmount() {
    if (this.scrollListener) {
      window.removeEventListener('scroll', this.scrollListener);
    }
  },
};
</script>

<style scoped>
.line-clamp-none {
  display: block;
}
.line-clamp-3 {
  overflow: hidden;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
}
</style>
