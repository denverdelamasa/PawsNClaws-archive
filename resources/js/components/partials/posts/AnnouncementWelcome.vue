<template>
    <div v-if="announcement" :key="announcement.announcement_id" class="card bg-base-200 w-full shadow-xl my-4 border border-base-300 w-3/4">
    <!-- Header with Title and Menu -->
    <div class="flex justify-end items-end p-4">
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
            <button class="btn bg-primary btn-sm text-base-300">
                <svg
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
                <p>{{ announcement.likes_count }}</p>
                Likes
            </button>
      
            <!-- Comments Button -->
            <button id="commentsBtn" class="btn btn-outline btn-sm flex gap-1 items-center" onclick="commentsModal.showModal()">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-5 w-5 stroke-current">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8H7M17 12H7M9 16H15M5 5V19L10 14H19C19.5523 14 20 13.5523 20 13V6C20 5.44772 19.5523 5 19 5H5Z" />
              </svg>
              <span>Comments</span>
            </button>
      
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
</template>
<script>
import axios from 'axios';

export default {
  data() {
    return {
      announcement: [],
    };
  },
  methods: {
    async fetchAnnouncement() {
      try {
        const response = await axios.get('/api/announcement/welcome');
        this.announcement = response.data;
      } catch (error) {
        console.error('Error fetching announcements:', error);
      }
    },
  },
  mounted() {
    this.fetchAnnouncement();
  },
};
</script>