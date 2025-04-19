<template>
    <div v-for="announcement in announcements" :key="announcement.announcement_id" class="card bg-base-200 w-full shadow-xl my-4 border border-base-300 w-3/4">
    <!-- Header with Title and Menu -->
    <div class="flex justify-end items-end p-4">
      <!-- Dropdown Menu -->
      <div class="dropdown dropdown-end z-50">
        <label tabindex="0" class="btn btn-sm btn-ghost">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
          </svg>
        </label>
        <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-300 rounded-box w-[230px]">
          <li><a href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
            </svg>
            Edit Announcement
          </a></li>
          <li><a href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
              <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
            </svg>
            Delete Announcement
          </a></li>
          <li><a href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-flag" viewBox="0 0 16 16">
              <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21 21 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21 21 0 0 0 14 7.655V1.222z"/>
            </svg>  
            Report Announcement
          </a></li>
        </ul>
      </div>
    </div>
  
    <!-- Card Body -->
    <div class="card-body mt-0">
        <div class="text-base mt-2 relative">
          <h2 class="card-title mb-2 text-3xl">{{ announcement.title }}</h2>
          <p>
            {{ announcement.description }}
          </p>
        </div>
        <div class="flex items-center space-x-3 mt-2">
            <div class="avatar">
                <div class="w-12 h-12 rounded-full">
                    <img :src="`/storage/${ announcement.profile_picture }`" alt="User Avatar">
                </div>
            </div>
            <div>
                <p class="text-sm font-semibold">{{ announcement.name }}</p>
                <div class="text-xs">
                    <span>{{ announcement.created_at }}</span>
                    <span class="mx-1">|</span>
                    <span>{{ announcement.updated_at }}</span>
                </div>
            </div>
        </div>       
    </div>
  
    <!-- Thumbnail -->
    <div v-if="announcement.thumbnail" class="m-4 rounded-lg max-h-[200px] overflow-hidden">
        <div id="slide1" class="carousel-item relative w-full">
            <img
                :src="`/storage/${announcement.thumbnail}`"
                class="w-full h-full object-cover" />
        </div>

    </div>

    <div class="card-body">
        <!-- Buttons -->
        <div class="flex gap-2 flex-wrap">
          <!-- Upvote Button -->
          <button 
            class="btn bg-primary btn-sm text-base-300" 
            @click="likeAnnouncement(announcement.announcement_id)">
            <svg
                v-if="announcement.is_liked"
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
            <p>{{ announcement.likes_count }} Like</p>
          </button>
    
          <!-- Comments Button -->
          <button id="commentsBtn" class="btn btn-outline btn-sm flex gap-1 items-center" @click="openModal(announcement.announcement_id)">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-5 w-5 stroke-current">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8H7M17 12H7M9 16H15M5 5V19L10 14H19C19.5523 14 20 13.5523 20 13V6C20 5.44772 19.5523 5 19 5H5Z" />
            </svg>
            <span>{{ announcement.comments_count}} Comments</span>
          </button>

          <Comments :isModalOpen="isModalOpen" :commentList="comments" @close="closeCommentsModal" :announcementId="selectedAnnouncementId"/>
    
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
<!-- Add loading indicator -->
<div v-if="loading" class="text-center my-4">
    <span class="loading loading-dots loading-lg"></span>
  </div>
  <div v-else-if="!hasMorePosts" class="text-center my-4">
    No more announcement to load
  </div>
</template>
<script>
import axios from 'axios';
import Comments from '../misc/Comments.vue';

export default {
  components: {
    Comments
  },
  data() {
    return {
      announcements: [],
      isModalOpen: false,
      selectedAnnouncementId: null,
      currentPage: 1,
      totalPages: 1,
      loading: false,
      hasMoreAnnouncement: true,
    };
  },
  methods: {
    async fetchAnnouncements(initialLoad = false) {
      if (this.loading || !this.hasMoreAnnouncement) return;
      
      this.loading = true;
      try {
        const response = await axios.get(`/api/user/announcement/list?page=${this.currentPage}`);
        
        if (initialLoad) {
          this.announcements = response.data.announcements;
        } else {
          this.announcements = [...this.announcements, ...response.data.announcements];
        }

        this.hasMoreAnnouncement = !!response.data.pagination.next_page_url;
        this.currentPage++;
      } catch (error) {
        console.error("Error fetching Announcement:", error);
      } finally {
        this.loading = false;
      }
    },

    handleScroll() {
      const bottomOfWindow =
        document.documentElement.scrollTop + window.innerHeight >=
        document.documentElement.offsetHeight - 100;

      if (bottomOfWindow && !this.loading && !this.hasMoreAnnouncement) {
        this.fetchAnnouncements();
      }
    },
    
    async likeAnnouncement(announcementId) {
      try {
        await axios.post(`/api/like/${announcementId}/announcement`);

        // Find the announcement and update its like state
        const announcement = this.announcements.find(ann => ann.announcement_id === announcementId);
        if (announcement) {
          announcement.is_liked = !announcement.is_liked; // Toggle like state
        }

        // Fetch the updated likes count
        await this.fetchLikesCount(announcementId, 'announcement');
      } catch (error) {
        console.error("Error liking/unliking announcement:", error);
      }
    },
    async fetchLikesCount(announcementId, type = 'announcement') {
      try {
        const response = await axios.get(`/api/like-count/${announcementId}/${type}`);
        const announcement = this.announcements.find(ann => ann.announcement_id === announcementId);
        if (announcement) {
          announcement.likes_count = response.data.likesCount; // Update likes count
        }
      } catch (error) {
        console.error("Error fetching likes count:", error);
      }
    },
    openModal(announcementId) {
      this.isModalOpen = true;
      console.log('ID: ', announcementId);
      this.fetchComments(announcementId);  // Fetch comments for the selected post  
      this.selectedAnnouncementId = announcementId;
    },
    closeCommentsModal() {
      this.isModalOpen = false;
      this.comments = [];  // Clear comments when modal is closed
      this.fetchAnnouncements();
    },
    async fetchComments(announcementId) {
      try {
        const response = await axios.get(`/api/comments/${announcementId}/announcement`);
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
  },
  mounted() {
    this.fetchComments();
    this.fetchAnnouncements();
    window.addEventListener('scroll', this.handleScroll);
  },
  beforeDestroy() {
    window.removeEventListener('scroll', this.handleScroll)
  }
};
</script>