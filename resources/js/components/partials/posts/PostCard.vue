<template>
  <UploadPost v-if="isAuthenticated" :fetchPostsProp="UpdatePosts" />

  <LoginFirst v-if="showLoginModal" ref="loginFirst" @close="showLoginModal = false" />
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

      <!-- Show "Adopted" when is_adoptable is 2 -->
      <div v-else-if="post.is_adoptable === 2" class="badge badge-info badge-outline gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-heart-fill" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
          <path fill-rule="evenodd" d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5zm4 5.982c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.69 0-5.018"/>
        </svg>
        Adopted
      </div>

      <!-- Hide both if is_adoptable is null or not set -->
      <div v-else class="hidden"></div>
      <!-- Dropdown Menu -->
      <div class="dropdown dropdown-end z-[100]">
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
            <a href="#" @click.prevent="openReportModal(post.post_id)">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-flag" viewBox="0 0 16 16">
                <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21 21 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21 21 0 0 0 14 7.655V1.222z" />
              </svg>
              Report Post
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

    <!-- Report Modal -->
    <ReportModal v-if="selectedReportPostId" :postId="selectedReportPostId" :reportType="'post'" :currentUserId="currentUserId" @close="closeReportModal"/>

    <!-- Card Body -->
    <div class="card-body">
      <div class="flex items-center space-x-3">
        <div class="avatar">
          <div class="w-12 h-12 rounded-full">
            <img :src="`/storage/${post.profile_picture}`" alt="User Avatar" />
          </div>
        </div>
        <div>
          <p class="text-sm font-medium">{{ post.name }}</p>
          <div class="text-xs">
            <span class="font-small">{{ post.username }}</span>
            <br>
            <span>Posted: {{ post.created_at }}</span>
            
            <template v-if="post.updated_at !== post.created_at">
              <span class="mx-1">|</span>
              <span>Edited</span>
            </template>
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

    <Comments :isCommentsModalOpen="isCommentsModalOpen" @close="closeCommentsModal" :postId="selectedCommentPostId"/>

      <!-- Bookmark Button -->
      <button id="bookmarkBtn" class="btn btn-outline btn-sm flex items-center gap-2">
        <svg id="bookmarkIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-plus" viewBox="0 0 16 16">
          <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/>
          <path d="M8 4a.5.5 0 0 1 .5.5V6H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1 0-1h1.5V4.5A.5.5 0 0 1 8 4"/>
        </svg>
        <span id="bookmarkText">Add to bookmarks</span>
      </button>

      <!-- Apply Adopt Button -->
      <button v-if="post.is_adoptable === 1 && post.user_id !== currentUserId && post.done_sending_adoption_form === false" @click="openAdoptionModal(post.post_id, post.user_id)" class="btn btn-outline btn-success btn-sm flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-paper-heart" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v1.133l.941.502A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765L2 3.133zm0 2.267-.47.25A1 1 0 0 0 1 5.4v.817l1 .6zm1 3.15 3.75 2.25L8 8.917l1.25.75L13 7.417V2a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1zm11-.6 1-.6V5.4a1 1 0 0 0-.53-.882L14 4.267zM8 2.982C9.664 1.309 13.825 4.236 8 8 2.175 4.236 6.336 1.31 8 2.982m7 4.401-4.778 2.867L15 13.117zm-.035 6.88L8 10.082l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738ZM1 13.116l4.778-2.867L1 7.383v5.734Z"/>
        </svg>
        <span>Send Adoption Form</span>
      </button>
      <!-- Apply Adopt Button -->
      <button v-if="post.done_sending_adoption_form === true && post.is_adoptable !== 2" class="btn btn-outline btn-active btn-warning btn-sm flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-paper-heart-fill" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="m3 7.5 3.5 2L8 8.75l1.5.75 3.5-2v-6A1.5 1.5 0 0 0 11.5 0h-7A1.5 1.5 0 0 0 3 1.5zM2 3.133l-.941.502A2 2 0 0 0 0 5.4v.313l2 1.173zm12 3.753 2-1.173V5.4a2 2 0 0 0-1.059-1.765L14 3.133zm-3.693 3.324L16 6.873v6.5zm5.634 4.274L8 10.072.059 14.484A2 2 0 0 0 2 16h12a2 2 0 0 0 1.941-1.516M5.693 10.21 0 13.372v-6.5zM8 1.982C9.664.309 13.825 3.236 8 7 2.175 3.236 6.336.31 8 1.982"/>
        </svg>
        <span>Done Sending Adoption Form</span>
      </button>
      <!-- Adoption Form Modal -->
      <AdoptionForm 
        :isOpen="isAdoptionModalOpen"
        :postId="adoptionPostId"
        :receiverUserId="receiverUserId"
        :currentUserId="currentUserId"
        @close="closeAdoptionModal"
        @confirmForm="submitAdoptionForm"
      />
    </div>
    </div>
  </div>

  <div v-if="loading" class="text-center my-4">
    <span class="loading loading-dots loading-lg"></span>
  </div>
  <!-- Display "No more posts available" when noMorePosts is true -->
  <div v-if="noMorePosts && posts.length > 0" class="text-center py-4 text-gray-500">
    No more posts available.
  </div>
</template>
<script>
import axios from "axios";
import Swal from 'sweetalert2';
import UploadPost from "../misc/UploadPost.vue";
import Comments from '../misc/Comments.vue';
import ReportModal from "../misc/Reports.vue";
import AdoptionForm from "../misc/AdoptionForm.vue";
import LoginFirst from "../misc/LoginFirst.vue";

export default {
  components: {
    UploadPost,
    Comments,
    ReportModal,
    AdoptionForm,
    LoginFirst,
  },
  data() {
    return {
      posts: [],
      currentIndex: {},
      currentPage: 1, // Current page number
      totalPages: 1, // Total number of pages
      loading: false, // Loading state
      noMorePosts: false, // Flag to check if there are no more posts
      expanded: false,
      isAuthenticated: false,
      currentUserId: null,
      selectedPost: { caption: '' },
      isCommentsModalOpen: false,
      selectedReportPostId: null,  // for report modal
      selectedCommentPostId: null, // for comment modal
      reportReason: '',
      customReason: '',
      invalidSocmedLink: false,
      isAdoptionModalOpen: false,
      adoptionPostId: null,
      receiverUserId: null,
      showLoginModal: false
    };
  },
  methods: {
    openAdoptionModal(postId, userId) {
      if (!this.isAuthenticated) {
        this.triggerLoginModal();
        return;
      }
      this.adoptionPostId = postId;
      this.receiverUserId = userId;
      this.isAdoptionModalOpen = true;
    },
    closeAdoptionModal() {
      this.isAdoptionModalOpen = false;
      this.UpdatePosts();;
    },
    handleFileChange(event) {
      const file = event.target.files[0];
      if (file) {
        this.formData.govIdFile = file;
      } else {
        this.formData.govIdFile = null;
      }
    },
    async submitAdoptionForm(formData) {
      const formDataToSend = new FormData();
      formDataToSend.append('receiver_id', this.receiverUserId);
      formDataToSend.append('post_id', this.adoptionPostId);
      formDataToSend.append('sender_id', this.currentUserId);
      formDataToSend.append('adopter_name', formData.adopterName);
      formDataToSend.append('contact_info', formData.contactInfo);
      formDataToSend.append('adopt_type', formData.adoptType);
      formDataToSend.append('employment_status', formData.employmentStatus);
      formDataToSend.append('socmed', formData.socmed);
      formDataToSend.append('location', formData.location);
      formDataToSend.append('experience', formData.experience);
      formDataToSend.append('reason', formData.reason);
      formDataToSend.append('current_pets', formData.currentPets);
      formDataToSend.append('gov_id', formData.govIdFile);

      try {
        const response = await axios.post('/api/adoption/submit', formDataToSend, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        });
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Your application has been submitted successfully!',
          showConfirmButton: true,
          confirmButtonText: 'OK',
          background: '#2c2f36',
          color: '#fff',
          confirmButtonColor: '#3085d6',
          toast: true,
          timer: 3000,
          timerProgressBar: true,
        });
        this.closeAdoptionModal();
      } catch (error) {
        console.error(error.response.data);
        Swal.fire({
          position: 'center',
          icon: 'error',
          title: 'Failed to submit the application.',
          showConfirmButton: true,
          background: '#2c2f36',
          color: '#fff',
          toast: true,
          timer: 3000,
        });
      }
    },
    openCommentsModal(postId) {
      this.isCommentsModalOpen = true;
      this.fetchComments(postId);  // Fetch comments for the selected post  
      this.selectedCommentPostId = postId;
    },
    closeCommentsModal() {
      this.isCommentsModalOpen = false;
      this.UpdatePosts();;
    },
    async fetchComments(postId) {
      try {
        const response = await axios.get(`/api/comments/${postId}/post`);
        this.comments = response.data.data;  // Access the 'data' array from the API response
        this.pagination = {
          current_page: response.data.current_page,
          last_page: response.data.last_page,
          per_page: response.data.per_page,
          total: response.data.total
        };
      } catch (error) {
        console.error("Error fetching comments:", error);
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
            this.UpdatePosts();  // Refresh the posts list
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
    openReportModal(postId) {
      if (!this.isAuthenticated) {
        this.triggerLoginModal();
        return;
      }
      this.reportType = 'post';
      this.selectedReportPostId = postId;
    },
    closeReportModal() {
      this.selectedReportPostId = null;
    },
    toggleDescription(post) {
      if (!("expanded" in post)) {
        post.expanded = false; // Initialize if it doesn't exist
      }
      post.expanded = !post.expanded;
    },
    showModal(postId) {
      console.log("Opening modal for post:", postId);

      // Ensure the index is set to 0 if undefined
      if (!(postId in this.currentIndex)) {
        this.currentIndex[postId] = 0;
      }

      const modal = document.getElementById(`thumbnailModal-${postId}`);
      if (modal) {
        modal.showModal();
      } else {
        console.log("Modal not found");
      }
    },
    closeThumbnailModal(postId) {
        const modal = document.getElementById(`thumbnailModal-${postId}`);
        if (modal) {
        modal.close();
        }
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
    UpdatePosts() {
      this.loading = true; // Show loader when starting request

      axios.get('/api/posts/list')
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

    async fetchPosts(reset = false) {
      if (this.loading || (this.noMorePosts && !reset)) return; // Prevent multiple requests unless resetting

      this.loading = true;

      try {
        if (reset) {
          // Reset the posts array and current page if reset is true
          this.posts = [];
          this.currentPage = 1;
          this.noMorePosts = false;
        }

        const response = await axios.get(`/api/posts/list?page=${this.currentPage}`);
        const newPosts = response.data.posts;

        if (newPosts.length > 0) {
          if (reset) {
            // Replace the posts array with the new posts
            this.posts = newPosts;
          } else {
            // Append new posts to the existing list
            this.posts = [...this.posts, ...newPosts];
          }
          this.currentPage++;
        } else {
          this.noMorePosts = true; // No more posts to load
        }
      } catch (error) {
        console.error("Error fetching posts:", error);
      } finally {
        this.loading = false;
      }
    },

    handleScroll() {
      const bottomOfWindow =
        document.documentElement.scrollTop + window.innerHeight >=
        document.documentElement.offsetHeight - 100; // 100px buffer

      if (bottomOfWindow && !this.loading && !this.noMorePosts) {
        this.fetchPosts(); // Fetch more posts
      }
    },
    triggerLoginModal() {
      this.showLoginModal = true;
      this.$nextTick(() => {
        const loginFirst = this.$refs.loginFirst;
        if (loginFirst) {
          loginFirst.showLoginModal();
        }
      });
    },
    async likePost(postId) {
      if (!this.isAuthenticated) {
        this.triggerLoginModal();
        return;
      }
      
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
    validateSocmedLink() {
      const socmedPattern = /^(https?:\/\/)?(www\.)?(facebook|instagram|x|twitter|tiktok|linkedin)\.(com|co|io)\/[a-zA-Z0-9_.-]+(\/)?$/;

      if (this.formData.socmed && !socmedPattern.test(this.formData.socmed)) {
        this.invalidSocmedLink = true; // Set to true if invalid
      } else {
        this.invalidSocmedLink = false; // Set to false if valid
      }
    },
  },
  mounted() {
    this.checkAuthentication();
    this.fetchPosts(true); // Fetch the first page of posts
    this.fetchComments();
    window.addEventListener('scroll', this.handleScroll);
  },
  beforeDestroy() {
    window.removeEventListener('scroll', this.handleScroll); // Clean up scroll event listener
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
  .loading {
    color: #4a5568; /* Customize spinner color */
  }

  .text-center {
    text-align: center;
  }

  .text-gray-500 {
    color: #6b7280; /* Adjust the color as needed */
  }
  .py-4 {
    padding-top: 1rem;
    padding-bottom: 1rem;
  }
  
</style>
