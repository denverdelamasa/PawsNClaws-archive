<template>
  <UploadPost v-if="isAuthenticated" :fetch-posts="fetchPosts" />
  <div v-for="post in posts" :key="post.post_id" class="card bg-base-200 w-full shadow-xl my-4 border border-base-300">
    <!-- Header with Title and Menu -->
    <div class="flex justify-end items-end p-4">
      <!-- Dropdown Menu -->
      <div class="dropdown dropdown-end z-50">
        <label tabindex="0" class="btn btn-sm btn-ghost">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3" />
          </svg>
        </label>
        <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-300 rounded-box w-40">
          <li>
            <a href="#" @click.prevent="editPost">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
              </svg>
              Edit Post
            </a>
          </li>
          <li>
            <a href="#" @click.prevent="deletePost">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
              </svg>
              Delete Post
            </a>
          </li>
        </ul>
      </div>
    </div>

    <!-- Thumbnail -->
    <div class="px-4 hover:cursor-pointer" @click="showModal('thumbnailModal')">
      <img v-if="post.image_path" :src="`/storage/${post.image_path}`" alt="Thumbnail" class="w-full max-h-[400px] rounded object-cover" />
    </div>

    <!-- Modal Thumbnail -->
    <dialog id="thumbnailModal" class="modal">
      <div class="modal-box w-[90vw] h-[90vh] max-w-7xl max-h-screen">
        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" @click="closeModal('thumbnailModal')">✕</button>
        <div class="flex justify-center items-center h-full">
          <img src="https://picsum.photos/1920/1080" alt="Thumbnail" class="max-w-full max-h-full rounded object-cover" />
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
          <p class="text-sm font-semibold">{{ post.username }}</p>
          <div class="text-xs">
            <span>Posted on: {{ post.created_at }}</span>
            <span class="mx-1">|</span>
            <span>Edited on: {{ post.updated_at }}</span>
          </div>
        </div>
      </div>
      <div class="text-base mt-2">
        <p class="line-clamp-3" v-bind:class="{ 'line-clamp-none': expanded }">
            {{ post.caption }}
        </p>
        <button class="btn btn-link btn-xs text-sm mt-2 px-0" @click="toggleDescription">{{ expanded ? 'See Less' : 'See More' }}</button>
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
        <p>{{ post.likes_count }} Likes</p>
        </button>


        <!-- Comments Button -->
        <button id="commentsBtn" class="btn btn-outline btn-sm flex gap-1 items-center" @click="openModal">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-5 w-5 stroke-current">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8H7M17 12H7M9 16H15M5 5V19L10 14H19C19.5523 14 20 13.5523 20 13V6C20 5.44772 19.5523 5 19 5H5Z" />
          </svg>
          <span>Comments</span>
        </button>
        <Comments
            v-if="isModalOpen" 
            @close-modal="closeModal"
        />

      <!-- Bookmark Button -->
      <button id="bookmarkBtn" class="btn btn-outline btn-sm flex items-center gap-2">
        <svg id="bookmarkIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-plus" viewBox="0 0 16 16">
          <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/>
          <path d="M8 4a.5.5 0 0 1 .5.5V6H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1 0-1h1.5V4.5A.5.5 0 0 1 8 4"/>
        </svg>
        <span id="bookmarkText">Add to bookmarks</span>
      </button>
    </div>
    </div>
  </div>
  <div v-if="posts.length === 0">
    No posts available.
  </div>
</template>

<script>
import axios from "axios";
import { ref } from 'vue';
import UploadPost from "../misc/UploadPost.vue";
import Comments from "../misc/CommentModal.vue";


export default {
  components: {
    UploadPost,
    Comments,
  },
  data() {
    return {
      posts:[],
      expanded: false,
      isAuthenticated: false,
      isModalOpen: false,
    };
  },
  methods: {
    toggleDescription() {
      this.expanded = !this.expanded;
    },
    showModal(id) {
      document.getElementById(id).showModal();
    },
    closeModal(id) {
      document.getElementById(id).close();
    },
    editPost() {
      console.log("Edit post clicked.");
    },
    deletePost() {
      console.log("Delete post clicked.");
    },
    async fetchPosts() {
    try {
      const response = await axios.get("/api/posts/list");
      this.posts = response.data;
    } catch (error) {
      console.error("Error fetching posts:", error);
    }
  },
  async likePost(postId) {
    try {
      const response = await axios.post(`/api/like/${postId}`);
      
      // After liking/unliking the post, update the likes count and state
      const post = this.posts.find(post => post.post_id === postId);
      if (post) {
        post.is_liked = !post.is_liked; // Toggle like state
        await this.fetchLikesCount(postId); // Fetch updated likes count after liking/unliking
      }
    } catch (error) {
      console.error("Error liking/unliking post:", error);
    }
  },
  async fetchLikesCount(postId) {
    try {
      const response = await axios.get(`/api/like-count/${postId}`);
      const post = this.posts.find(post => post.post_id === postId);
      if (post) {
        post.likes_count = response.data.likesCount; // Update likes count
      }
    } catch (error) {
      console.error("Error fetching likes count:", error);
    }
  },
    editPost(postId) {
      console.log("Edit post clicked for ID:", postId);
    },
    deletePost(postId) {
      console.log("Delete post clicked for ID:", postId);
    },
    async checkAuthentication() {
      try {
        const response = await axios.get('/api/auth/status');  // Your endpoint to check authentication
        this.isAuthenticated = response.data.authenticated;  // Assume the response returns { authenticated: true/false }
      } catch (error) {
        console.error("Error checking authentication status:", error);
      }
    },
    
  },
  mounted() {
    this.checkAuthentication();
    this.fetchPosts();
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
