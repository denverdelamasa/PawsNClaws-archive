<template>
  <div>
    <!-- Upload Post Component (used for all types: announcements, posts, events) -->
    <UploadPost v-if="isAuthenticated" :fetchFeedProp="updateFeed" />
    <LoginFirst v-if="showLoginModal" ref="loginFirst" @close="showLoginModal = false" />

    <!-- Combined Feed -->
    <div v-for="item in combinedFeed" :key="item.id" class="card bg-base-200 w-full shadow-xl my-4 border border-base-300 w-3/4 mx-auto">
      <!-- Announcement -->
      <template v-if="item.type === 'announcement'">
        <!-- Header with Dropdown Menu -->
        <div class="flex justify-end items-end p-4">
          <div class="dropdown dropdown-end z-50">
            <label tabindex="0" class="btn btn-sm btn-ghost">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
              </svg>
            </label>
            <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-300 rounded-box w-[230px]">
              <li v-if="item.owner_id === currentUserId">
                <a href="#" @click.prevent="editAnnouncement(item)">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                  </svg>
                  Edit Announcement
                </a>
              </li>
              <li v-if="item.owner_id === currentUserId">
                <a href="#" @click.prevent="openDeleteModal(item.id, 'announcement')">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                  </svg>
                  Delete Announcement
                </a>
              </li>
              <li v-if="item.owner_id !== currentUserId">
                <a href="#" @click.prevent="openReportModal(item.id, 'announcement')">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-flag" viewBox="0 0 16 16">
                    <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21 21 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21 21 0 0 0 14 7.655V1.222z"/>
                  </svg>
                  Report Announcement
                </a>
              </li>
            </ul>
          </div>
        </div>

        <!-- Card Body -->
        <div class="card-body mt-0">
          <div class="text-base mt-2 relative">
            <h2 class="card-title mb-2 text-3xl">{{ item.title }}</h2>
            <p>{{ item.description }}</p>
          </div>
          <div class="flex items-center space-x-3 mt-2">
            <div class="avatar">
              <div class="w-12 h-12 rounded-full">
                <img :src="`/storage/${item.profile_picture}`" alt="Shelter Avatar" />
              </div>
            </div>
            <div>
              <p class="text-sm font-semibold">{{ item.name }}</p>
              <div class="text-xs">
                <span>{{ item.created_at }}</span>
                <template v-if="item.updated_at !== item.created_at">
                  <span class="mx-1">|</span>
                  <span>Edited</span>
                </template>
              </div>
            </div>
          </div>
        </div>

        <!-- Thumbnail -->
        <div v-if="item.thumbnail" class="m-4 rounded-lg max-h-[200px] overflow-hidden">
          <img :src="`/storage/${item.thumbnail}`" class="w-full h-full object-cover" />
        </div>

        <!-- Edit Announcement Modal -->
        <dialog :id="`editAnnouncementModal-${item.id}`" class="modal">
          <div class="modal-box w-[90vw] h-[40vh] max-w-2xl">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" @click="closeEditModal(item.id, 'announcement')">✕</button>
            <h3 class="text-xl font-semibold">Edit Announcement</h3>
            <form @submit.prevent="submitEditAnnouncement(item.id)">
              <div class="my-4">
                <label for="title" class="label">Title</label>
                <input type="text" v-model="selectedItem.title" id="title" class="textarea textarea-bordered w-full" rows="1" />
                <label for="description" class="label">Description</label>
                <textarea v-model="selectedItem.description" id="description" class="textarea textarea-bordered w-full" rows="3"></textarea>
              </div>
              <div class="modal-action">
                <button class="btn btn-primary">Save Changes</button>
              </div>
            </form>
          </div>
        </dialog>

        <!-- Delete Confirmation Modal -->
        <dialog :id="`deleteModal-${item.id}-announcement`" class="modal">
          <div class="modal-box">
            <h3 class="text-lg font-bold">Are you sure you want to delete this announcement?</h3>
            <p class="py-4">This action cannot be undone.</p>
            <div class="modal-action">
              <button class="btn btn-error" @click="confirmDelete(item.id, 'announcement')">Yes, Delete</button>
              <button class="btn" @click="closeDeleteModal(item.id, 'announcement')">Cancel</button>
            </div>
          </div>
        </dialog>
      </template>

      <!-- Event -->
      <template v-if="item.type === 'event'">
        <!-- Header with Dropdown Menu -->
        <div class="flex flex-row items-end p-4 justify-between align-middle">
          <div class="flex justify-end w-full">
            <div class="dropdown dropdown-end z-50">
              <label tabindex="0" class="btn btn-sm btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                  <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
                </svg>
              </label>
              <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-300 rounded-box w-40">
                <li v-if="item.owner_id === currentUserId">
                  <a href="#" @click.prevent="editEvent(item)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg>
                    Edit Event
                  </a>
                </li>
                <li v-if="item.owner_id === currentUserId">
                  <a href="#" @click.prevent="openDeleteModal(item.id, 'event')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                      <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                    </svg>
                    Delete Event
                  </a>
                </li>
                <li v-if="item.owner_id !== currentUserId">
                  <a href="#" @click.prevent="openReportModal(item.id, 'event')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-flag" viewBox="0 0 16 16">
                      <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21 21 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21 21 0 0 0 14 7.655V1.222z"/>
                    </svg>
                    Report Event
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Thumbnail -->
        <div v-if="item.event_thumbnail && item.event_thumbnail.length > 0" class="relative w-full rounded-lg">
          <div class="overflow-hidden rounded-lg">
            <div class="flex transition-transform duration-300" :style="{ transform: `translateX(-${item.currentSlide * 100}%)` }">
              <div v-for="(thumbnail, index) in item.event_thumbnail" :key="index" class="w-full flex-shrink-0">
                <img :src="`/storage/${thumbnail}`" :alt="`Event thumbnail ${index + 1}`" class="w-full object-cover rounded-lg" />
              </div>
            </div>
          </div>
          <div v-if="item.event_thumbnail.length > 1" class="absolute inset-0 flex items-center justify-between px-4">
            <button v-if="item.currentSlide > 0" type="button" @click.stop="prevSlide(item)" class="btn btn-circle bg-white bg-opacity-50 hover:bg-opacity-70">❮</button>
            <div v-else class="w-10"></div>
            <button v-if="item.currentSlide < item.event_thumbnail.length - 1" type="button" @click.stop="nextSlide(item)" class="btn btn-circle bg-white bg-opacity-50 hover:bg-opacity-70">❯</button>
            <div v-else class="w-10"></div>
          </div>
          <div v-if="item.event_thumbnail.length > 1" class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2">
            <button v-for="(_, index) in item.event_thumbnail" :key="index" @click.stop="goToSlide(item, index)" class="w-3 h-3 rounded-full bg-gray-300 hover:bg-gray-400" :class="{ 'bg-white': item.currentSlide === index }"></button>
          </div>
        </div>

        <!-- Card Body -->
        <div class="card-body">
          <div class="text-base mt-2 relative">
            <h2 class="card-title mb-2 text-3xl">{{ item.event_title }}</h2>
            <div class="text-xs w-full mb-4">
              <span>From: {{ item.event_start_date }}</span>
              <span class="mx-1">|</span>
              <span>To: {{ item.event_end_date }}</span>
            </div>
            <p class="break-words whitespace-normal text-sm sm:text-base">
              {{ item.expanded ? item.event_description : (item.event_description && item.event_description.length > 135 ? item.event_description.substring(0, 135) + '...' : item.event_description) }}
            </p>
            <button v-if="item.event_description && item.event_description.length > 125" class="btn btn-link btn-xs text-sm mt-2" @click="toggleDescription(item)">
              {{ item.expanded ? 'See Less' : 'See More' }}
            </button>
          </div>
          <div class="flex items-center space-x-3 mt-2">
            <div class="avatar">
              <div class="w-12 h-12 rounded-full">
                <img :src="`/storage/${item.profile_picture}`" alt="Shelter Avatar" />
              </div>
            </div>
            <div>
              <p class="text-sm font-semibold">{{ item.name }}</p>
              <div class="text-xs">
                <span>{{ item.created_at }}</span>
                <span class="mx-1">|</span>
                <span>{{ item.updated_at }}</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Edit Event Modal -->
        <dialog :id="`editEventModal-${item.id}`" class="modal">
          <div class="modal-box w-[90vw] h-[40vh] max-w-2xl">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" @click="closeEditModal(item.id, 'event')">✕</button>
            <h3 class="text-xl font-semibold">Edit Event</h3>
            <form @submit.prevent="submitEditEvent(item.id)">
              <div class="my-4">
                <label for="event_title" class="label">Title</label>
                <input type="text" v-model="selectedItem.event_title" id="event_title" class="textarea textarea-bordered w-full" rows="1" />
                <label for="event_description" class="label">Description</label>
                <textarea v-model="selectedItem.event_description" id="event_description" class="textarea textarea-bordered w-full" rows="3"></textarea>
                <label for="event_start_date" class="label">Start Date</label>
                <input type="date" v-model="selectedItem.event_start_date" id="event_start_date" class="input input-bordered w-full" />
                <label for="event_end_date" class="label">End Date</label>
                <input type="date" v-model="selectedItem.event_end_date" id="event_end_date" class="input input-bordered w-full" />
              </div>
              <div class="modal-action">
                <button class="btn btn-primary">Save Changes</button>
              </div>
            </form>
          </div>
        </dialog>

        <!-- Delete Confirmation Modal -->
        <dialog :id="`deleteModal-${item.id}-event`" class="modal">
          <div class="modal-box">
            <h3 class="text-lg font-bold">Are you sure you want to delete this event?</h3>
            <p class="py-4">This action cannot be undone.</p>
            <div class="modal-action">
              <button class="btn btn-error" @click="confirmDelete(item.id, 'event')">Yes, Delete</button>
              <button class="btn" @click="closeDeleteModal(item.id, 'event')">Cancel</button>
            </div>
          </div>
        </dialog>
      </template>

      <!-- Post -->
      <template v-if="item.type === 'post'">
        <!-- Header with Adoption Status and Dropdown Menu -->
        <div class="flex justify-end items-end p-4 gap-x-2">
          <div v-if="item.is_adoptable === 1" class="badge badge-warning badge-outline gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-heart" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M5 1.5A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5v1A1.5 1.5 0 0 1 9.5 4h-3A1.5 1.5 0 0 1 5 2.5zm5 0a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5z"/>
              <path d="M3 1.5h1v1H3a1 1 0 0 0-1 1V14a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V3.5a1 1 0 0 0-1-1h-1v-1h1a2 2 0 0 1 2 2V14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3.5a2 2 0 0 1 2-2"/>
              <path d="M8 6.982C9.664 5.309 13.825 8.236 8 12 2.175 8.236 6.336 5.31 8 6.982"/>
            </svg>
            Open for Adoption
          </div>
          <div v-else-if="item.is_adoptable === 2" class="badge badge-info badge-outline gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-heart-fill" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
              <path fill-rule="evenodd" d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5zm4 5.982c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.69 0-5.018"/>
            </svg>
            Adopted
          </div>
          <div v-else class="hidden"></div>
          <div class="dropdown dropdown-end z-[100]">
            <label tabindex="0" class="btn btn-sm btn-ghost">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
              </svg>
            </label>
            <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-300 rounded-box w-40">
              <li v-if="item.owner_id === currentUserId">
                <a href="#" @click.prevent="editPost(item)">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                  </svg>
                  Edit Post
                </a>
              </li>
              <li v-if="item.owner_id === currentUserId">
                <a href="#" @click.prevent="openDeleteModal(item.id, 'post')">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                  </svg>
                  Delete Post
                </a>
              </li>
              <li v-if="item.owner_id !== currentUserId">
                <a href="#" @click.prevent="openReportModal(item.id, 'post')">
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
        <div v-if="item.image_path && item.image_path.length > 0" class="relative px-4 hover:cursor-pointer" @click="showModal(item.id, 'post')">
          <div class="w-full h-[300px] sm:h-[250px] md:h-[280px] lg:h-[300px] overflow-hidden rounded">
            <img :src="`/storage/${Array.isArray(item.image_path) ? item.image_path[0] : item.image_path}`" alt="Thumbnail" class="w-full h-full object-cover transition-transform duration-300 ease-in-out hover:scale-110" />
          </div>
          <div v-if="Array.isArray(item.image_path) && item.image_path.length > 1" class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center rounded">
            <span class="text-white text-lg font-semibold">+{{ item.image_path.length - 1 }}</span>
          </div>
        </div>

        <!-- Modal Thumbnail -->
        <dialog v-if="item.image_path" :id="`thumbnailModal-${item.id}`" class="modal backdrop-blur-sm">
            <div class="modal-box w-full max-w-4xl max-h-[90vh] p-0 bg-white dark:bg-gray-800 rounded-xl shadow-2xl overflow-hidden relative transform transition-all duration-300">
                <!-- Close Button -->
                <button 
                class="btn btn-sm btn-circle btn-ghost absolute right-4 top-4 z-10 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                @click="closeThumbnailModal(item.id)"
                aria-label="Close modal"
                >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                </button>

                <!-- Image Carousel -->
                <div class="relative h-[60vh] md:h-[70vh] flex items-center justify-center">
                <!-- Previous Button -->
                <button 
                    v-if="item.image_path.length > 1 && currentIndex[item.id] > 0" 
                    class="absolute left-4 p-3 bg-gray-900/60 hover:bg-gray-900/80 text-white rounded-full transition-all duration-200 hover:scale-110"
                    @click="prevImage(item.id)"
                    aria-label="Previous image"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <!-- Image -->
                <img 
                    :src="`/storage/${item.image_path[currentIndex[item.id]]}`" 
                    alt="Thumbnail" 
                    class="max-w-full max-h-full object-contain rounded-lg transition-opacity duration-300"
                    :class="{ 'opacity-100': true, 'opacity-0': false }"
                />

                <!-- Next Button -->
                <button 
                    v-if="item.image_path.length > 1 && currentIndex[item.id] < item.image_path.length - 1" 
                    class="absolute right-4 p-3 bg-gray-900/60 hover:bg-gray-900/80 text-white rounded-full transition-all duration-200 hover:scale-110"
                    @click="nextImage(item.id)"
                    aria-label="Next image"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                </div>

                <!-- Image Counter -->
                <div v-if="item.image_path.length > 1" class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-gray-900/70 text-white px-3 py-1 rounded-full text-sm">
                {{ currentIndex[item.id] + 1 }} / {{ item.image_path.length }}
                </div>

                <!-- Caption (optional, can be customized) -->
                <div class="p-4 text-center text-gray-600 dark:text-gray-300 text-sm">
                <p>{{ item.caption || 'Image preview' }}</p>
                </div>
            </div>
        </dialog>

        <!-- Card Body -->
        <div class="card-body">
          <div class="flex items-center space-x-3">
            <div class="avatar">
              <div class="w-12 h-12 rounded-full">
                <img :src="`/storage/${item.profile_picture}`" alt="User Avatar" />
              </div>
            </div>
            <div>
              <p class="text-sm font-medium">{{ item.name }}</p>
              <div class="text-xs">
                <span class="font-small">{{ item.username }}</span>
                <br />
                <span>Posted: {{ item.created_at }}</span>
                <template v-if="item.updated_at !== item.created_at">
                  <span class="mx-1">|</span>
                  <span>Edited</span>
                </template>
              </div>
            </div>
          </div>
          <div class="text-base mt-2 w-full">
            <p class="break-words whitespace-normal text-sm sm:text-base">
              {{ item.expanded ? item.caption : (item.caption && item.caption.length > 135 ? item.caption.substring(0, 135) + '...' : item.caption) }}
            </p>
            <button v-if="item.caption && item.caption.length > 125" class="btn btn-link btn-xs text-sm mt-2" @click="toggleDescription(item)">
              {{ item.expanded ? 'See Less' : 'See More' }}
            </button>
          </div>
        </div>

        <!-- Edit Post Modal -->
        <dialog :id="`editPostModal-${item.id}`" class="modal">
          <div class="modal-box w-[90vw] h-[40vh] max-w-2xl">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" @click="closeEditModal(item.id, 'post')">✕</button>
            <h3 class="text-xl font-semibold">Edit Post</h3>
            <form @submit.prevent="submitEditPost(item.id)">
              <div class="my-4">
                <label for="caption" class="label">Caption</label>
                <textarea v-model="selectedItem.caption" id="caption" class="textarea textarea-bordered w-full" rows="4"></textarea>
                <label for="is_adoptable" class="label">Adoption Status</label>
                <select v-model="selectedItem.is_adoptable" id="is_adoptable" class="select select-bordered w-full">
                  <option value="0">Not Adoptable</option>
                  <option value="1">Open for Adoption</option>
                  <option value="2">Adopted</option>
                </select>
              </div>
              <div class="modal-action">
                <button class="btn btn-primary">Save Changes</button>
              </div>
            </form>
          </div>
        </dialog>

        <!-- Delete Confirmation Modal -->
        <dialog :id="`deleteModal-${item.id}-post`" class="modal">
          <div class="modal-box">
            <h3 class="text-lg font-bold">Are you sure you want to delete this post?</h3>
            <p class="py-4">This action cannot be undone.</p>
            <div class="modal-action">
              <button class="btn btn-error" @click="confirmDelete(item.id, 'post')">Yes, Delete</button>
              <button class="btn" @click="closeDeleteModal(item.id, 'post')">Cancel</button>
            </div>
          </div>
        </dialog>
      </template>

      <!-- Shared Modals and Buttons -->
      <ReportModal v-if="selectedReportId" :itemId="selectedReportId" :reportType="reportType" :currentUserId="currentUserId" @close="closeReportModal" />
      <AdoptionForm v-if="item.type === 'post'" :isOpen="isAdoptionModalOpen" :postId="adoptionPostId" :receiverUserId="receiverUserId" :currentUserId="currentUserId" @close="closeAdoptionModal" @confirmForm="submitAdoptionForm" />
      <Comments 
        :isCommentsModalOpen="isCommentsModalOpen"
        :postId="selectedCommentItemType === 'post' ? selectedCommentItemId : null"
        :announcementId="selectedCommentItemType === 'announcement' ? selectedCommentItemId : null"
        :eventId="selectedCommentItemType === 'event' ? selectedCommentItemId : null"
        :currentUserId="currentUserId"
        @close="closeCommentsModal"
        />

      <!-- Interaction Buttons -->
      <div class="card-body">
        <div class="flex gap-2 flex-wrap">
          <!-- Like Button -->
            <button class="btn bg-primary btn-sm text-base-300" @click="likeItem(item.id, item.type)">
                <svg v-if="item.is_liked" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                </svg>
                <p>{{ item.likes_count }} Like</p>
            </button>

          <!-- Comments Button -->
          <button class="btn btn-outline btn-sm flex gap-1 items-center" @click="openCommentsModal(item.id, item.type)">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-5 w-5 stroke-current">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8H7M17 12H7M9 16H15M5 5V19L10 14H19C19.5523 14 20 13.5523 20 13V6C20 5.44772 19.5523 5 19 5H5Z" />
            </svg>
            <span>{{ item.comments_count }} Comments</span>
          </button>

          <!-- Bookmark Button -->
          <button class="btn btn-outline btn-sm flex items-center gap-2" @click="bookmarkItem(item.id, item.type)">
            <svg v-if="item.is_bookmarked" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-fill" viewBox="0 0 16 16">
              <path d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2z"/>
            </svg>
            <svg v-else xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-plus" viewBox="0 0 16 16">
              <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/>
              <path d="M8 4a.5.5 0 0 1 .5.5V6H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1 0-1h1.5V4.5A.5.5 0 0 1 8 4"/>
            </svg>
            <span>{{ item.is_bookmarked ? 'Bookmarked' : 'Add to bookmarks' }}</span>
          </button>

          <!-- Adoption Buttons (only for posts) -->
          <button v-if="item.type === 'post' && item.is_adoptable === 1 && item.owner_id !== currentUserId && !item.done_sending_adoption_form" @click="openAdoptionModal(item.id, item.owner_id)" class="btn btn-outline btn-success btn-sm flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-paper-heart" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v1.133l.941.502A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765L2 3.133zm0 2.267-.47.25A1 1 0 0 0 1 5.4v.817l1 .6zm1 3.15 3.75 2.25L8 8.917l1.25.75L13 7.417V2a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1zm11-.6 1-.6V5.4a1 1 0 0 0-.53-.882L14 4.267zM8 2.982C9.664 1.309 13.825 4.236 8 8 2.175 4.236 6.336 1.31 8 2.982m7 4.401-4.778 2.867L15 13.117zm-.035 6.88L8 10.082l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738ZM1 13.116l4.778-2.867L1 7.383v5.734Z"/>
            </svg>
            <span>Send Adoption Form</span>
          </button>
          <button v-if="item.type === 'post' && item.done_sending_adoption_form && item.is_adoptable !== 2" class="btn btn-outline btn-active btn-warning btn-sm flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-paper-heart-fill" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="m3 7.5 3.5 2L8 8.75l1.5.75 3.5-2v-6A1.5 1.5 0 0 0 11.5 0h-7A1.5 1.5 0 0 0 3 1.5zM2 3.133l-.941.502A2 2 0 0 0 0 5.4v.313l2 1.173zm12 3.753 2-1.173V5.4a2 2 0 0 0-1.059-1.765L14 3.133zm-3.693 3.324L16 6.873v6.5zm5.634 4.274L8 10.072.059 14.484A2 2 0 0 0 2 16h12a2 2 0 0 0 1.941-1.516M5.693 10.21 0 13.372v-6.5zM8 1.982C9.664.309 13.825 3.236 8 7 2.175 3.236 6.336.31 8 1.982"/>
            </svg>
            <span>Done Sending Adoption Form</span>
          </button>
        </div>
      </div>
    </div>

    <!-- Loading Indicator -->
    <div v-if="loading" class="text-center my-4">
      <span class="loading loading-dots loading-lg"></span>
    </div>

    <!-- No More Items Message -->
    <div v-if="noMoreItems && combinedFeed.length > 0" class="text-center py-4 text-gray-500">
      No more items available.
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';
import Comments from '../misc/Comments.vue';
import UploadPost from '../misc/UploadPost.vue';
import ReportModal from '../misc/Reports.vue';
import AdoptionForm from '../misc/AdoptionForm.vue';
import LoginFirst from '../misc/LoginFirst.vue';

export default {
  components: {
    Comments,
    UploadPost,
    ReportModal,
    AdoptionForm,
    LoginFirst,
  },
  data() {
    return {
      combinedFeed: [],
      currentPage: {
        announcements: 1,
        posts: 1,
        events: 1,
      },
      totalPages: {
        announcements: 1,
        posts: 1,
        events: 1,
      },
      loading: false,
      noMoreItems: false,
      isAuthenticated: false,
      currentUserId: null,
      selectedItem: {},
      isCommentsModalOpen: false,
      selectedCommentItemId: null,
      selectedCommentItemType: null,
      selectedReportId: null,
      reportType: '',
      isAdoptionModalOpen: false,
      adoptionPostId: null,
      receiverUserId: null,
      showLoginModal: false,
      currentIndex: {},
    };
  },
  methods: {
    async fetchFeed(reset = false) {
        if (this.loading || (this.noMoreItems && !reset)) return;

        this.loading = true;

        try {
            if (reset) {
            this.combinedFeed = [];
            this.currentPage = { announcements: 1, posts: 1, events: 1 };
            this.noMoreItems = false;
            }

            console.log('Fetching feed with pages:', this.currentPage); // Debug log

            const response = await axios.get(`/api/feed/list`, {
            params: {
                announcement_page: this.currentPage.announcements,
                post_page: this.currentPage.posts,
                event_page: this.currentPage.events,
            },
            });

            const { announcements, posts, events, announcements_pagination, posts_pagination, events_pagination } = response.data;

            console.log('Received data:', { announcements, posts, events }); // Debug log

            // Normalize data for combined feed
            const normalizedAnnouncements = announcements.map(item => ({
            id: item.announcement_id,
            type: 'announcement',
            owner_id: item.shelter_id,
            title: item.title,
            description: item.description,
            thumbnail: item.thumbnail,
            name: item.name,
            username: item.username,
            profile_picture: item.profile_picture,
            created_at: item.created_at,
            updated_at: item.updated_at,
            likes_count: item.likes_count,
            is_liked: item.is_liked,
            comments_count: item.comments_count,
            is_adoptable: item.is_adoptable,
            }));

            const normalizedPosts = posts.map(item => ({
            id: item.post_id,
            type: 'post',
            owner_id: item.user_id,
            caption: item.caption,
            image_path: item.image_path,
            name: item.name,
            username: item.username,
            profile_picture: item.profile_picture,
            created_at: item.created_at,
            updated_at: item.updated_at,
            likes_count: item.likes_count,
            is_liked: item.is_liked,
            comments_count: item.comments_count,
            is_adoptable: item.is_adoptable,
            done_sending_adoption_form: item.done_sending_adoption_form,
            is_bookmarked: item.is_bookmarked,
            expanded: false,
            }));

            const normalizedEvents = events.map(item => ({
            id: item.event_id,
            type: 'event',
            owner_id: item.shelter_id,
            event_title: item.event_title,
            event_description: item.event_description,
            event_thumbnail: item.event_thumbnail,
            event_start_date: item.event_start_date,
            event_end_date: item.event_end_date,
            name: item.name,
            username: item.username,
            profile_picture: item.profile_picture,
            created_at: item.created_at,
            updated_at: item.updated_at,
            likes_count: item.likes_count,
            is_liked: item.is_liked,
            comments_count: item.comments_count,
            is_adoptable: item.is_adoptable,
            currentSlide: 0,
            expanded: false,
            }));

            // Combine and sort by created_at
            const newItems = [...normalizedAnnouncements, ...normalizedPosts, ...normalizedEvents].sort(
            (a, b) => new Date(b.created_at) - new Date(a.created_at)
            );

            this.combinedFeed = reset ? newItems : [...this.combinedFeed, ...newItems];

            // Update pagination
            this.totalPages.announcements = announcements_pagination.last_page;
            this.totalPages.posts = posts_pagination.last_page;
            this.totalPages.events = events_pagination.last_page;

            // Increment pages for the next fetch only if there are more items
            if (announcements.length > 0 && this.currentPage.announcements < this.totalPages.announcements) {
            this.currentPage.announcements += 1;
            }
            if (posts.length > 0 && this.currentPage.posts < this.totalPages.posts) {
            this.currentPage.posts += 1;
            }
            if (events.length > 0 && this.currentPage.events < this.totalPages.events) {
            this.currentPage.events += 1;
            }

            // Check if there are no more items to fetch
            this.noMoreItems =
            (announcements.length === 0 || this.currentPage.announcements > this.totalPages.announcements) &&
            (posts.length === 0 || this.currentPage.posts > this.totalPages.posts) &&
            (events.length === 0 || this.currentPage.events > this.totalPages.events);

            console.log('Updated pagination:', {
            currentPage: this.currentPage,
            totalPages: this.totalPages,
            noMoreItems: this.noMoreItems,
            }); // Debug log
        } catch (error) {
            console.error('Error fetching feed:', error);
            Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Failed to load feed. Please try again.',
            });
        } finally {
            this.loading = false;
        }
    },

    async updateFeed() {
      await this.fetchFeed(true);
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
    

    async likeItem(itemId, itemType) {
        if (!this.isAuthenticated) {
            this.showLoginModal = true;
            return;
        }
        try {
            const response = await axios.post(`/api/like/${itemId}/${itemType}`);
            const item = this.combinedFeed.find(i => i.id === itemId && i.type === itemType);
            if (item) {
            item.is_liked = response.data.is_liked;
            item.likes_count = response.data.likes_count; // Immediate update
            // Fetch updated count to ensure accuracy
            await this.fetchLikesCount(itemId, itemType);
            await this.fetchFeed();
            } else {
            console.warn(`Item not found in combinedFeed: ${itemType} ${itemId}`);
            }
        } catch (error) {
            console.error(`Error liking ${itemType}:`, {
            message: error.message,
            status: error.response?.status,
            data: error.response?.data,
            });
            Swal.fire({
            icon: 'error',
            title: 'Error',
            text: `Failed to like ${itemType}. ${error.response?.data?.message || 'Please try again.'}`,
            });
        }
    },

    async fetchLikesCount(itemId, itemType) {
        try {
            const response = await axios.get(`/api/like-count/${itemId}/${itemType}`);
            const item = this.combinedFeed.find(i => i.id === itemId && i.type === itemType);
            if (item) {
            item.likes_count = response.data.likesCount;
            console.log(`Updated likes_count for ${itemType} ${itemId}:`, item.likes_count);
            } else {
            console.warn(`Item not found in combinedFeed: ${itemType} ${itemId}`);
            }
        } catch (error) {
            console.error(`Error fetching likes count for ${itemType} ${itemId}:`, {
            message: error.message,
            status: error.response?.status,
            data: error.response?.data,
            });
        }
    },

    async bookmarkItem(itemId, itemType) {
      if (!this.isAuthenticated) {
        this.showLoginModal = true;
        return;
      }

      try {
        const response = await axios.post(`/api/${itemType}s/${itemId}/bookmark`);
        const item = this.combinedFeed.find(i => i.id === itemId && i.type === itemType);
        if (item) {
          item.is_bookmarked = response.data.is_bookmarked;
        }
      } catch (error) {
        console.error(`Error bookmarking ${itemType}:`, error);
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: `Failed to bookmark ${itemType}. Please try again.`,
        });
      }
    },

    editAnnouncement(item) {
      this.selectedItem = { ...item };
      document.getElementById(`editAnnouncementModal-${item.id}`).showModal();
    },

    editEvent(item) {
      this.selectedItem = { ...item };
      document.getElementById(`editEventModal-${item.id}`).showModal();
    },

    editPost(item) {
      this.selectedItem = { ...item };
      document.getElementById(`editPostModal-${item.id}`).showModal();
    },

    async submitEditAnnouncement(itemId) {
      try {
        await axios.put(`/api/announcements/${itemId}`, {
          title: this.selectedItem.title,
          description: this.selectedItem.description,
        });
        const item = this.combinedFeed.find(i => i.id === itemId && i.type === 'announcement');
        if (item) {
          item.title = this.selectedItem.title;
          item.description = this.selectedItem.description;
          item.updated_at = new Date().toISOString();
        }
        document.getElementById(`editAnnouncementModal-${itemId}`).close();
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'Announcement updated successfully!',
        });
      } catch (error) {
        console.error('Error updating announcement:', error);
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Failed to update announcement. Please try again.',
        });
      }
    },

    async submitEditEvent(itemId) {
      try {
        await axios.put(`/api/events/${itemId}`, {
          event_title: this.selectedItem.event_title,
          event_description: this.selectedItem.event_description,
          event_start_date: this.selectedItem.event_start_date,
          event_end_date: this.selectedItem.event_end_date,
        });
        const item = this.combinedFeed.find(i => i.id === itemId && i.type === 'event');
        if (item) {
          item.event_title = this.selectedItem.event_title;
          item.event_description = this.selectedItem.event_description;
          item.event_start_date = this.selectedItem.event_start_date;
          item.event_end_date = this.selectedItem.event_end_date;
          item.updated_at = new Date().toISOString();
        }
        document.getElementById(`editEventModal-${itemId}`).close();
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'Event updated successfully!',
        });
      } catch (error) {
        console.error('Error updating event:', error);
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Failed to update event. Please try again.',
        });
      }
    },

    async submitEditPost(itemId) {
      try {
        await axios.put(`/api/posts/${itemId}`, {
          caption: this.selectedItem.caption,
          is_adoptable: this.selectedItem.is_adoptable,
        });
        const item = this.combinedFeed.find(i => i.id === itemId && i.type === 'post');
        if (item) {
          item.caption = this.selectedItem.caption;
          item.is_adoptable = this.selectedItem.is_adoptable;
          item.updated_at = new Date().toISOString();
        }
        document.getElementById(`editPostModal-${itemId}`).close();
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'Post updated successfully!',
        });
      } catch (error) {
        console.error('Error updating post:', error);
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Failed to update post. Please try again.',
        });
      }
    },

    openDeleteModal(itemId, itemType) {
      document.getElementById(`deleteModal-${itemId}-${itemType}`).showModal();
    },

    closeDeleteModal(itemId, itemType) {
      document.getElementById(`deleteModal-${itemId}-${itemType}`).close();
    },

    async confirmDelete(itemId, itemType) {
      try {
        await axios.delete(`/api/${itemType}s/${itemId}`);
        this.combinedFeed = this.combinedFeed.filter(i => !(i.id === itemId && i.type === itemType));
        document.getElementById(`deleteModal-${itemId}-${itemType}`).close();
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: `${itemType.charAt(0).toUpperCase() + itemType.slice(1)} deleted successfully!`,
        });
      } catch (error) {
        console.error(`Error deleting ${itemType}:`, error);
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: `Failed to delete ${itemType}. Please try again.`,
        });
      }
    },

    openReportModal(itemId, reportType) {
      if (!this.isAuthenticated) {
        this.showLoginModal = true;
        return;
      }
      this.selectedReportId = itemId;
      this.reportType = reportType;
    },

    closeReportModal() {
      this.selectedReportId = null;
      this.reportType = '';
    },

    openAdoptionModal(postId, receiverUserId) {
      if (!this.isAuthenticated) {
        this.showLoginModal = true;
        return;
      }
      this.adoptionPostId = postId;
      this.receiverUserId = receiverUserId;
      this.isAdoptionModalOpen = true;
    },

    closeAdoptionModal() {
      this.isAdoptionModalOpen = false;
      this.adoptionPostId = null;
      this.receiverUserId = null;
    },

    async submitAdoptionForm(formData) {
      try {
        await axios.post(`/api/posts/${this.adoptionPostId}/adoption-form`, formData);
        const item = this.combinedFeed.find(i => i.id === this.adoptionPostId && i.type === 'post');
        if (item) {
          item.done_sending_adoption_form = true;
        }
        this.closeAdoptionModal();
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'Adoption form submitted successfully!',
        });
      } catch (error) {
        console.error('Error submitting adoption form:', error);
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Failed to submit adoption form. Please try again.',
        });
      }
    },

    openCommentsModal(itemId, itemType) {
        if (!this.isAuthenticated) {
            this.showLoginModal = true;
            return;
        }
        console.log('Opening comments modal:', { itemId, itemType }); // Debug log
        this.selectedCommentItemId = itemId;
        this.selectedCommentItemType = itemType;
        this.isCommentsModalOpen = true;
    },

    closeCommentsModal() {
        this.isCommentsModalOpen = false;
        this.selectedCommentItemId = null;
        this.selectedCommentItemType = null;
    },

    toggleDescription(item) {
      item.expanded = !item.expanded;
    },

    prevSlide(item) {
      if (item.currentSlide > 0) {
        item.currentSlide -= 1;
      }
    },

    nextSlide(item) {
      if (item.currentSlide < item.event_thumbnail.length - 1) {
        item.currentSlide += 1;
      }
    },

    goToSlide(item, index) {
      item.currentSlide = index;
    },

    showModal(itemId, itemType) {
      if (itemType === 'post') {
        this.currentIndex[itemId] = this.currentIndex[itemId] || 0;
        document.getElementById(`thumbnailModal-${itemId}`).showModal();
      }
    },

    closeThumbnailModal(itemId) {
      document.getElementById(`thumbnailModal-${itemId}`).close();
    },

    prevImage(itemId) {
      if (this.currentIndex[itemId] > 0) {
        this.currentIndex[itemId] -= 1;
      }
    },

    nextImage(itemId) {
      const item = this.combinedFeed.find(i => i.id === itemId && i.type === 'post');
      if (item && this.currentIndex[itemId] < item.image_path.length - 1) {
        this.currentIndex[itemId] += 1;
      }
    },

    closeEditModal(itemId, itemType) {
      document.getElementById(`edit${itemType.charAt(0).toUpperCase() + itemType.slice(1)}Modal-${itemId}`).close();
      this.selectedItem = {};
    },

    handleScroll() {
      if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 100 && !this.loading && !this.noMoreItems) {
        this.fetchFeed();
      }
    },
  },
  mounted() {
    this.checkAuthentication();
    this.fetchFeed();
    window.addEventListener('scroll', this.handleScroll);
  },
  beforeDestroy() {
    window.removeEventListener('scroll', this.handleScroll);
  },
};
</script>

<style scoped>
/* Add any additional styles if needed */
.card {
  transition: all 0.3s ease;
}
.card:hover {
  transform: translateY(-2px);
}
.modal[open] {
  animation: fadeIn 0.3s ease-out;
}

.modal-box {
  animation: slideIn 0.3s ease-out;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes slideIn {
  from { transform: translateY(20px); opacity: 0; }
  to { transform: translateY(0); opacity: 1; }
}

/* Responsive Adjustments */
@media (max-width: 640px) {
  .modal-box {
    max-width: 95vw;
    max-height: 80vh;
  }
  .modal-box > div:first-child {
    height: 50vh;
  }
}

@media (min-width: 641px) and (max-width: 1024px) {
  .modal-box {
    max-width: 80vw;
  }
}

/* Dark Mode Support */
.dark .modal-box {
  background-color: #1f2937;
}
</style>