<template>
  <UploadPost v-if="isAuthenticated" :fetch-posts="fetchPosts" />
  <div v-for="post in posts" :key="post.post_id" class="card bg-base-200 w-full shadow-xl my-4 border border-base-300">
    <!-- Header with Title and Menu -->
    <div class="flex justify-end items-end p-4 gap-x-2">
      <div class="badge badge-warning badge-outline gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-heart" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M5 1.5A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5v1A1.5 1.5 0 0 1 9.5 4h-3A1.5 1.5 0 0 1 5 2.5zm5 0a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5z"/>
          <path d="M3 1.5h1v1H3a1 1 0 0 0-1 1V14a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V3.5a1 1 0 0 0-1-1h-1v-1h1a2 2 0 0 1 2 2V14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3.5a2 2 0 0 1 2-2"/>
          <path d="M8 6.982C9.664 5.309 13.825 8.236 8 12 2.175 8.236 6.336 5.31 8 6.982"/>
        </svg>
        If open for adoption
      </div>
      <div class="badge badge-info badge-outline gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-heart-fill" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
          <path fill-rule="evenodd" d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5zm4 5.982c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.69 0-5.018"/>
        </svg>
        If adopted na
      </div>
      <!-- Dropdown Menu -->
      <div class="dropdown dropdown-end z-50">
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
            <li v-if="post.user_id !== currentUserId">
                <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-flag" viewBox="0 0 16 16">
                    <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21 21 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21 21 0 0 0 14 7.655V1.222z"/>
                </svg>  
                Report Post
                </a>
            </li>
        </ul>
      </div>
    </div>

    <!-- Thumbnail -->
    <div class="px-4 hover:cursor-pointer" @click="showModal(post.post_id)">
    <img v-if="post.image_path" :src="`/storage/${post.image_path}`" alt="Thumbnail" class="w-full max-h-[400px] rounded object-cover" />
    </div>

    <!-- Edit Post Modal -->
    <dialog :id="`editPostModal-${post.post_id}`" class="modal">
        <div class="modal-box w-[90vw] h-[60vh] max-w-2xl">
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
            <h3 class="text-lg font-bold">Are you sure you want to delete this post?</h3>
            <p class="py-4">This action cannot be undone.</p>
            <div class="modal-action">
                <button class="btn btn-error" @click="confirmDelete(post.post_id)">Yes, Delete</button>
                <button class="btn" @click="closeDeleteModal(post.post_id)">Cancel</button>
            </div>
        </div>
    </dialog>

    <!-- Modal Thumbnail -->
    <dialog :id="`thumbnailModal-${post.post_id}`" class="modal">
        <div class="modal-box w-[90vw] h-[90vh] max-w-7xl max-h-screen">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" @click="closeThumbnailModal(post.post_id)">✕</button>
            <div class="flex justify-center items-center h-full">
            <img :src="`/storage/${post.image_path}`" alt="Thumbnail" class="max-w-full max-h-full rounded object-cover" />
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
        <p>{{ post.likes_count }} Like</p>
        </button>

      <!-- Comments Button -->
      <button class="btn btn-outline btn-sm flex gap-1 items-center" @click="openModal(post.post_id)">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-5 w-5 stroke-current">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8H7M17 12H7M9 16H15M5 5V19L10 14H19C19.5523 14 20 13.5523 20 13V6C20 5.44772 19.5523 5 19 5H5Z" />
      </svg>
      <span>{{ post.comments_count}} Comments</span>
    </button>

    <Comments :isModalOpen="isModalOpen" :comments="comments" @close="closeCommentsModal" :postId="selectedPostId"/>

      <!-- Bookmark Button -->
      <button id="bookmarkBtn" class="btn btn-outline btn-sm flex items-center gap-2">
        <svg id="bookmarkIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-plus" viewBox="0 0 16 16">
          <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/>
          <path d="M8 4a.5.5 0 0 1 .5.5V6H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1 0-1h1.5V4.5A.5.5 0 0 1 8 4"/>
        </svg>
        <span id="bookmarkText">Add to bookmarks</span>
      </button>

      <!-- Apply Adopt Button -->
      <button onclick="document.getElementById('adoptionModal').showModal()" class="btn btn-outline btn-success btn-sm flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-paper-heart" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v1.133l.941.502A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765L2 3.133zm0 2.267-.47.25A1 1 0 0 0 1 5.4v.817l1 .6zm1 3.15 3.75 2.25L8 8.917l1.25.75L13 7.417V2a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1zm11-.6 1-.6V5.4a1 1 0 0 0-.53-.882L14 4.267zM8 2.982C9.664 1.309 13.825 4.236 8 8 2.175 4.236 6.336 1.31 8 2.982m7 4.401-4.778 2.867L15 13.117zm-.035 6.88L8 10.082l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738ZM1 13.116l4.778-2.867L1 7.383v5.734Z"/>
        </svg>
        <span>if iaadopt palang button</span>
      </button>
      <!-- Apply Adopt Button -->
      <button onclick="document.getElementById('adoptionModal').showModal()" class="btn btn-outline btn-active btn-warning btn-sm flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-paper-heart-fill" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="m3 7.5 3.5 2L8 8.75l1.5.75 3.5-2v-6A1.5 1.5 0 0 0 11.5 0h-7A1.5 1.5 0 0 0 3 1.5zM2 3.133l-.941.502A2 2 0 0 0 0 5.4v.313l2 1.173zm12 3.753 2-1.173V5.4a2 2 0 0 0-1.059-1.765L14 3.133zm-3.693 3.324L16 6.873v6.5zm5.634 4.274L8 10.072.059 14.484A2 2 0 0 0 2 16h12a2 2 0 0 0 1.941-1.516M5.693 10.21 0 13.372v-6.5zM8 1.982C9.664.309 13.825 3.236 8 7 2.175 3.236 6.336.31 8 1.982"/>
        </svg>
        <span>if nakapag send na ng application button</span>
      </button>
      <dialog id="adoptionModal" class="modal">
        <div class="modal-box w-96 h-auto max-w-6xl max-h-[80vh] hide-scrollbar">
          <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" onclick="document.getElementById('adoptionModal').close()">✕</button>
          </form>
          
          <h3 class="text-lg font-bold mb-4">Adoption Application</h3>
          
          <!-- Adoption Form -->
          <form action="#" method="POST">
            <!-- 1. Full Name  -->
            <div class="mb-4">
              <label for="adopterName" class="block text-sm font-medium">Full Name</label>
              <p class="m-2 text-xs text-secondary" >ex: Denver Dela Masa </p>
              <input type="text" id="adopterName" name="adopterName" class="input input-bordered w-full" required>
            </div>

            <!-- 2. Contact Info -->
            <div class="mb-4">
              <label for="contactInfo" class="block text-sm font-medium">Contact Info </label>
              <p class="m-2 text-xs text-secondary" >(Phone or Email)</p>
              <input type="text" id="contactInfo" name="contactInfo" class="input input-bordered w-full" required>
            </div>
            <div class="flex flex-row justify-between gap-x-2">
              <!-- 3. Individual/Organization/Shelter -->
              <div class="mb-4 w-full">
                <label for="adoptType" class="block text-sm font-medium">Who Are You Representing?</label>
                <select id="adoptType" name="adoptType" class="select select-bordered w-full" required>
                  <option value="individual">Individual</option>
                  <option value="organization">Organization</option>
                  <option value="shelter">Shelter</option>
                </select>
              </div>

              <!-- 9. Student/Employed/Volunteer -->
              <div class="mb-4 w-full">
                <label for="employmentStatus" class="block text-sm font-medium">Current Status</label>
                <select id="employmentStatus" name="employmentStatus" class="select select-bordered w-full" required>
                  <option value="student">Student</option>
                  <option value="employed">Employed</option>
                  <option value="volunteer">Volunteer</option>
                </select>
              </div>
            </div>

            <!-- 4. Complete Location -->
            <div class="mb-4">
              <label for="location" class="block text-sm font-medium">Location</label>
              <p class="m-2 text-xs text-secondary">1234 Maple Street, Apartment 5B, Town, City</p>
              <input type="text" id="location" name="location" class="input input-bordered w-full" required>
            </div>

            <!-- 5. Experience with Pets -->
            <div class="mb-4">
              <label for="experience" class="block text-sm font-medium">Pet Experience Pet</label>
              <p class="m-2 text-xs text-secondary">Any pets you have taken care of?</p>
              <textarea id="experience" name="experience" rows="4" class="textarea textarea-bordered w-full" required></textarea>
            </div>

            <!-- 6. Reason for Adopting -->
            <div class="mb-4">
              <label for="reason" class="block text-sm font-medium">Reason for Adopting</label>
              <textarea id="reason" name="reason" rows="6" class="textarea textarea-bordered w-full" required></textarea>
            </div>

            <!-- 7. Number of Current Pets -->
            <div class="mb-4">
              <label for="currentPets" class="block text-sm font-medium">Number of Current Pets</label>
              <input 
                type="number" 
                id="currentPets" 
                name="currentPets" 
                class="input input-bordered w-full" 
                min="0" 
                value="0" 
                required>
            </div>

            <!-- 8. Valid Gov. ID -->
            <div class="mb-4">
              <label for="govId" class="block text-sm font-medium">Valid Government ID (Upload)</label>
              <input type="file" id="govId" name="govId" class="file-input file-input-bordered w-full" accept=".jpg,.jpeg,.png,.pdf" required>
            </div>

            <!-- Submit Button -->
            <div class="mb-4 flex flex-col justify-center items-center">
              <!-- Apply Adopt Button -->
              <button type="submit" onclick="document.getElementById('adoptionModal').showModal()" class="btn btn-outline btn-warning btn-md flex items-center gap-2 m-4">
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
      </dialog>





    </div>
    </div>
  </div>
  <div v-if="posts.length === 0">
    No posts available.
  </div>
</template>
<script>
  import axios from "axios";
  import Swal from 'sweetalert2';
  import UploadPost from "../misc/UploadPost.vue";
  import Comments from '../misc/Comments.vue';

  export default {
    components: {
      UploadPost,
      Comments
    },
    data() {
      return {
          posts: [],
        expanded: false,
        isAuthenticated: false,
        currentUserId: null,
        selectedPost: { caption: '' },
        isModalOpen: false,
        comments: [],  // Store comments here,
        selectedPostId: null,
      };
    },
    methods: {
      openModal(postId) {
        this.isModalOpen = true;
        this.fetchComments(postId);  // Fetch comments for the selected post  
        this.selectedPostId = postId;
      },
      closeCommentsModal() {
        this.isModalOpen = false;
        this.comments = [];  // Clear comments when modal is closed
      },
      fetchComments(postId) {
        axios.get(`/api/comments/post/${postId}`)
          .then(response => {
            this.comments = response.data;  // Store fetched comments
          })
          .catch(error => {
            console.error("Error fetching comments:", error);
          });
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
            this.posts = this.posts.filter(post => post.post_id !== postId);
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
          console.log(this.selectedPost); // Log selectedPost to check category_id

          axios.put(`/api/post/edit/${this.selectedPost.post_id}`, this.selectedPost, {
          })
          .then(response => {
              this.$emit('post-updated', response.data);  // Emit event to parent if needed
              this.fetchPosts();  // Refresh the posts list
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
      toggleDescription() {
        this.expanded = !this.expanded;
      },
      showModal(postId) {
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
