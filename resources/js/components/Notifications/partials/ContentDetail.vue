<template>
  <div class="content-detail card bg-base-200 w-full max-w-2xl mx-auto shadow-xl my-4 border border-base-300">
    <!-- Loading State -->
    <div v-if="loading" class="text-center my-4">
      <span class="loading loading-dots loading-lg"></span>
    </div>

    <!-- Error State -->
    <div v-if="error" class="alert alert-error">
      <span>{{ error }}</span>
    </div>

    <!-- Content Display -->
    <div v-if="content" class="relative">
      <!-- Header with Adoption Status and Menu -->
      <div class="flex justify-end items-end p-4 gap-x-2">
        <!-- Adoption Status (for Posts) -->
        <div v-if="content.type === 'post' && content.is_adoptable === 1" class="badge badge-warning badge-outline gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-heart" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M5 1.5A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5v1A1.5 1.5 0 0 1 9.5 4h-3A1.5 1.5 0 0 1 5 2.5zm5 0a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5z"/>
            <path d="M3 1.5h1v1H3a1 1 0 0 0-1 1V14a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V3.5a1 1 0 0 0-1-1h-1v-1h1a2 2 0 0 1 2 2V14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3.5a2 2 0 0 1 2-2"/>
            <path d="M8 6.982C9.664 5.309 13.825 8.236 8 12 2.175 8.236 6.336 5.31 8 6.982"/>
          </svg>
          Open for Adoption
        </div>
        <div v-else-if="content.type === 'post' && content.is_adoptable === 2" class="badge badge-info badge-outline gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-heart-fill" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
            <path fill-rule="evenodd" d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5zm4 5.982c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.69 0-5.018"/>
          </svg>
          Adopted
        </div>

        <!-- Dropdown Menu -->
        <div class="dropdown dropdown-end z-[19]">
          <label tabindex="0" class="btn btn-sm btn-ghost">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
              <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3" />
            </svg>
          </label>
          <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-300 rounded-box w-40">
            <li v-if="content.user_id === currentUserId || content.shelter_id === currentUserId">
              <a href="#" @click.prevent="editContent">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                </svg>
                Edit {{ content.type }}
              </a>
            </li>
            <li v-if="content.user_id === currentUserId || content.shelter_id === currentUserId">
              <a href="#" @click.prevent="openDeleteModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                </svg>
                Delete {{ content.type }}
              </a>
            </li>
            <li v-if="content.user_id !== currentUserId && content.shelter_id !== currentUserId">
              <a href="#" @click.prevent="openReportModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-flag" viewBox="0 0 16 16">
                  <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21 21 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21 21 0 0 0 14 7.655V1.222z" />
                </svg>
                Report {{ content.type }}
              </a>
            </li>
          </ul>
        </div>
      </div>

      <!-- Thumbnail -->
      <div v-if="content.image_path?.length || content.event_thumbnail?.length || content.thumbnail" 
           class="relative px-4 hover:cursor-pointer" 
           @click="showModal">
        <div class="w-full h-[300px] overflow-hidden rounded">
          <img :src="`/storage/${getThumbnail}`" 
               alt="Thumbnail" 
               class="w-full h-full object-cover transition-transform duration-300 ease-in-out hover:scale-110" />
        </div>
        <!-- Overlay for Multiple Images -->
        <div v-if="isMultiImage && (content.image_path?.length > 1 || content.event_thumbnail?.length > 1)" 
             class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center rounded">
          <span class="text-white text-lg font-semibold">+{{ (content.image_path?.length || content.event_thumbnail?.length) - 1 }}</span>
        </div>
      </div>

      <!-- Thumbnail Modal -->
      <dialog v-if="content.image_path || content.event_thumbnail || content.thumbnail" 
              id="thumbnailModal" 
              class="modal">
        <div class="modal-box w-[40vw] h-[40vh] max-w-7xl max-h-screen relative">
          <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" @click="closeThumbnailModal">✕</button>
          <div class="flex justify-center items-center h-full relative">
            <button v-if="isMultiImage && currentIndex > 0" 
                    class="absolute left-4 text-white text-2xl bg-black bg-opacity-50 p-2 rounded-full" 
                    @click="prevImage">
              &lt;
            </button>
            <img :src="`/storage/${getCurrentImage}`" 
                 alt="Thumbnail" 
                 class="max-w-full max-h-full rounded object-cover" />
            <button v-if="isMultiImage && currentIndex < imageCount - 1" 
                    class="absolute right-4 text-white text-2xl bg-black bg-opacity-50 p-2 rounded-full" 
                    @click="nextImage">
              &gt;
            </button>
          </div>
        </div>
      </dialog>

      <!-- Edit Modal -->
      <dialog id="editModal" class="modal">
        <div class="modal-box w-[90vw] h-[40vh] max-w-2xl">
          <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" @click="closeEditModal">✕</button>
          <h3 class="text-xl font-semibold">Edit {{ content.type }}</h3>
          <form @submit.prevent="submitEditContent">
            <div class="my-4">
              <label for="contentText" class="label">{{ content.type === 'post' ? 'Caption' : content.type === 'event' ? 'Description' : 'Description' }}</label>
              <textarea v-model="selectedContent.text" id="contentText" class="textarea textarea-bordered w-full" rows="4"></textarea>
            </div>
            <div class="modal-action">
              <button class="btn btn-primary">Save Changes</button>
            </div>
          </form>
        </div>
      </dialog>

      <!-- Delete Confirmation Modal -->
      <dialog id="deleteModal" class="modal">
        <div class="modal-box">
          <h3 class="text-lg font-bold">Are you sure you want to delete this {{ content.type }}?</h3>
          <p class="py-4">This action cannot be undone.</p>
          <div class="modal-action">
            <button class="btn btn-error" @click="confirmDelete">Yes, Delete</button>
            <button class="btn" @click="closeDeleteModal">Cancel</button>
          </div>
        </div>
      </dialog>

      <!-- Report Modal -->
      <ReportModal v-if="selectedReportId" 
                   :postId="selectedReportId" 
                   :reportType="content.type" 
                   :currentUserId="currentUserId" 
                   @close="closeReportModal"/>

      <!-- Card Body -->
      <div class="card-body">
        <div class="flex items-center space-x-3">
          <div class="avatar">
            <div class="w-12 h-12 rounded-full">
              <img :src="`/storage/${content.profile_picture}`" alt="User Avatar" />
            </div>
          </div>
          <div>
            <p class="text-sm font-medium">{{ content.name }}</p>
            <div class="text-xs">
              <span class="font-small">{{ content.username }}</span>
              <br>
              <span>Posted: {{ content.created_at }}</span>
              <template v-if="content.updated_at !== content.created_at">
                <span class="mx-1">|</span>
                <span>Edited</span>
              </template>
            </div>
          </div>
        </div>
        <div class="text-base mt-2 w-full">
          <h2 v-if="content.type === 'event' || content.type === 'announcement'" class="text-lg font-semibold">
            {{ content.event_title || content.title }}
          </h2>
          <p v-if="content.type === 'event'" class="text-sm">
            <strong>Location:</strong> {{ content.event_location }}<br>
            <strong>Start:</strong> {{ content.event_start_date }}<br>
            <strong>End:</strong> {{ content.event_end_date }}
          </p>
          <p class="break-words whitespace-normal text-sm sm:text-base">
            {{ expanded ? contentText : (contentText && contentText.length > 135 ? contentText.substring(0, 135) + '...' : contentText) }}
          </p>
          <button v-if="contentText && contentText.length > 135" 
                  class="btn btn-link btn-xs text-sm mt-2" 
                  @click="expanded = !expanded">
            {{ expanded ? 'See Less' : 'See More' }}
          </button>
        </div>
        <div class="flex gap-2 flex-wrap">
          <!-- Like Button -->
          <button class="btn bg-primary btn-sm text-base-300" @click="likeContent">
            <svg v-if="content.is_liked" 
                 xmlns="http://www.w3.org/2000/svg" 
                 class="h-6 w-6" 
                 fill="currentColor" 
                 viewBox="0 0 24 24">
              <path stroke-linecap="round" 
                    stroke-linejoin="round" 
                    stroke-width="2" 
                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
            <svg v-else 
                 xmlns="http://www.w3.org/2000/svg" 
                 class="h-6 w-6" 
                 fill="none" 
                 viewBox="0 0 24 24" 
                 stroke="currentColor">
              <path stroke-linecap="round" 
                    stroke-linejoin="round" 
                    stroke-width="2" 
                    d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
            </svg>
            <p>{{ content.likes_count }} Like</p>
          </button>

          <!-- Comments Button -->
          <button class="btn btn-outline btn-sm flex gap-1 items-center" @click="openCommentsModal">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-5 w-5 stroke-current">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8H7M17 12H7M9 16H15M5 5V19L10 14H19C19.5523 14 20 13.5523 20 13V6C20 5.44772 19.5523 5 19 5H5Z" />
            </svg>
            <span>{{ content.comments_count }} Comments</span>
          </button>

          <!-- Comments Modal -->
          <Comments :isCommentsModalOpen="isCommentsModalOpen" 
                    @close="closeCommentsModal" 
                    :postId="content.id" 
                    :commentType="content.type"/>

          <!-- Bookmark Button -->
          <button class="btn btn-outline btn-sm flex items-center gap-2" @click="bookmarkContent">
            <svg v-if="content.is_bookmarked" 
                 xmlns="http://www.w3.org/2000/svg" 
                 width="16" 
                 height="16" 
                 fill="currentColor" 
                 class="bi bi-bookmark-fill" 
                 viewBox="0 0 16 16">
              <path d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2z"/>
            </svg>
            <svg v-else 
                 xmlns="http://www.w3.org/2000/svg" 
                 width="16" 
                 height="16" 
                 fill="currentColor" 
                 class="bi bi-bookmark-plus" 
                 viewBox="0 0 16 16">
              <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/>
              <path d="M8 4a.5.5 0 0 1 .5.5V6H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1 0-1h1.5V4.5A.5.5 0 0 1 8 4"/>
            </svg>
            <span>{{ content.is_bookmarked ? 'Remove from bookmarks' : 'Add to bookmarks' }}</span>
          </button>

          <!-- Adoption Form Button (for Posts) -->
          <button v-if="content.type === 'post' && content.is_adoptable === 1 && content.user_id !== currentUserId && !content.done_sending_adoption_form" 
                  @click="openAdoptionModal" 
                  class="btn btn-outline btn-success btn-sm flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-paper-heart" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v1.133l.941.502A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765L2 3.133zm0 2.267-.47.25A1 1 0 0 0 1 5.4v.817l1 .6zm1 3.15 3.75 2.25L8 8.917l1.25.75L13 7.417V2a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1zm11-.6 1-.6V5.4a1 1 0 0 0-.53-.882L14 4.267zM8 2.982C9.664 1.309 13.825 4.236 8 8 2.175 4.236 6.336 1.31 8 2.982m7 4.401-4.778 2.867L15 13.117zm-.035 6.88L8 10.082l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738ZM1 13.116l4.778-2.867L1 7.383v5.734Z"/>
            </svg>
            <span>Send Adoption Form</span>
          </button>
          <button v-if="content.type === 'post' && content.done_sending_adoption_form && content.is_adoptable !== 2" 
                  class="btn btn-outline btn-active btn-warning btn-sm flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-paper-heart-fill" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="m3 7.5 3.5 2L8 8.75l1.5.75 3.5-2v-6A1.5 1.5 0 0 0 11.5 0h-7A1.5 1.5 0 0 0 3 1.5zM2 3.133l-.941.502A2 2 0 0 0 0 5.4v.313l2 1.173zm12 3.753 2-1.173V5.4a2 2 0 0 0-1.059-1.765L14 3.133zm-3.693 3.324L16 6.873v6.5zm5.634 4.274L8 10.072.059 14.484A2 2 0 0 0 2 16h12a2 2 0 0 0 1.941-1.516M5.693 10.21 0 13.372v-6.5zM8 1.982C9.664.309 13.825 3.236 8 7 2.175 3.236 6.336.31 8 1.982"/>
            </svg>
            <span>Done Sending Adoption Form</span>
          </button>

          <!-- Adoption Form Modal -->
          <AdoptionForm :isOpen="isAdoptionModalOpen"
                        :postId="content.id"
                        :receiverUserId="content.user_id"
                        :currentUserId="currentUserId"
                        @close="closeAdoptionModal"
                        @confirmForm="submitAdoptionForm"/>
        </div>
      </div>

      <!-- Comments Section -->
      <div class="space-y-4 p-2 bg-base-200 w-auto max-w-full mx-4 border-t-2 border-info pt-6">
        <div v-for="comment in content.comments" 
             :key="comment.comment_id" 
             class="bg-base-100 p-3 rounded-box shadow-sm flex flex-row justify-between items-start gap-x-4">
          <div class="flex flex-row gap-x-2">
            <div class="avatar">
              <div class="w-8 h-8 rounded-full">
                <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" 
                     alt="Commenter Avatar" />
              </div>
            </div>
            <div>
              <p class="font-semibold text-sm">User {{ comment.user_id }}</p>
              <p class="text-xs text-base-content/80">{{ comment.comment }}</p>
            </div>
          </div>
          <button class="btn btn-sm btn-primary text-base-300" @click="likeComment(comment)">
            <svg v-if="comment.is_liked" 
                 xmlns="http://www.w3.org/2000/svg" 
                 class="h-5 w-5" 
                 fill="currentColor" 
                 viewBox="0 0 24 24">
              <path stroke-linecap="round" 
                    stroke-linejoin="round" 
                    stroke-width="2" 
                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
            <svg v-else 
                 xmlns="http://www.w3.org/2000/svg" 
                 class="h-5 w-5" 
                 fill="none" 
                 viewBox="0 0 24 24" 
                 stroke="currentColor">
              <path stroke-linecap="round" 
                    stroke-linejoin="round" 
                    stroke-width="2" 
                    d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
            </svg>
            <span class="text-xs">{{ comment.likes_count || 1 }}</span>
          </button>
        </div>
        <div v-if="showMoreComments" class="space-y-4 transition-all duration-300">
          <!-- Additional comments can be loaded here if pagination is implemented -->
        </div>
        <div class="text-center">
          <button class="btn btn-outline btn-sm" @click="showMoreComments = !showMoreComments">
            {{ showMoreComments ? 'Show less' : 'Load more' }}
          </button>
        </div>
      </div>
    </div>

    <!-- Login Modal -->
    <LoginFirst v-if="showLoginModal" ref="loginFirst" @close="showLoginModal = false" />
  </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';
import Comments from '../../partials/misc/Comments.vue';
import ReportModal from '../../partials/misc/Reports.vue';
import AdoptionForm from '../../partials/misc/AdoptionForm.vue';
import LoginFirst from '../../partials/misc/LoginFirst.vue';

export default {
  components: {
    Comments,
    ReportModal,
    AdoptionForm,
    LoginFirst,
  },
  data() {
    return {
      content: null,
      notificationId: this.$route.params.notificationId,
      currentIndex: 0,
      loading: false,
      error: null,
      isAuthenticated: false,
      currentUserId: null,
      selectedContent: { text: '' },
      isCommentsModalOpen: false,
      selectedReportId: null,
      isAdoptionModalOpen: false,
      showLoginModal: false,
      showMoreComments: false,
      expanded: false,
    };
  },
  computed: {
    contentText() {
      return this.content?.caption || this.content?.event_description || this.content?.description || '';
    },
    getThumbnail() {
      if (this.content?.image_path?.length) return this.content.image_path[0];
      if (this.content?.event_thumbnail?.length) return this.content.event_thumbnail[0];
      return this.content?.thumbnail || '';
    },
    getCurrentImage() {
      if (this.content?.image_path?.length) return this.content.image_path[this.currentIndex];
      if (this.content?.event_thumbnail?.length) return this.content.event_thumbnail[this.currentIndex];
      return this.content?.thumbnail || '';
    },
    isMultiImage() {
      return (this.content?.image_path?.length > 1) || (this.content?.event_thumbnail?.length > 1);
    },
    imageCount() {
      return this.content?.image_path?.length || this.content?.event_thumbnail?.length || 1;
    },
  },
  methods: {
    async fetchContent() {
      this.loading = true;
      try {
        const response = await axios.get(`/api/notifications/${this.notificationId}/content`);
        this.content = response.data.content;
        // Ensure comments have a default likes_count and is_liked
        this.content.comments = this.content.comments.map(comment => ({
          ...comment,
          likes_count: comment.likes_count || 1,
          is_liked: comment.is_liked || false,
        }));
      } catch (error) {
        this.error = error.response?.data?.error || 'Failed to load content';
        console.error('Error fetching content:', error);
      } finally {
        this.loading = false;
      }
    },
    async checkAuthentication() {
      try {
        const response = await axios.get('/api/auth/status');
        this.isAuthenticated = response.data.authenticated;
        this.currentUserId = response.data.user_id;
      } catch (error) {
        console.error('Error checking authentication status:', error);
      }
    },
    showModal() {
      const modal = document.getElementById('thumbnailModal');
      if (modal) modal.showModal();
    },
    closeThumbnailModal() {
      const modal = document.getElementById('thumbnailModal');
      if (modal) modal.close();
    },
    nextImage() {
      if (this.currentIndex < this.imageCount - 1) {
        this.currentIndex++;
      }
    },
    prevImage() {
      if (this.currentIndex > 0) {
        this.currentIndex--;
      }
    },
    editContent() {
      if (!this.isAuthenticated) {
        this.triggerLoginModal();
        return;
      }
      this.selectedContent = {
        text: this.content.caption || this.content.event_description || this.content.description,
      };
      const modal = document.getElementById('editModal');
      if (modal) modal.showModal();
    },
    closeEditModal() {
      const modal = document.getElementById('editModal');
      if (modal) modal.close();
    },
    async submitEditContent() {
      if (!this.isAuthenticated) {
        this.triggerLoginModal();
        return;
      }
      try {
        const endpoint = this.content.type === 'post' ? `/api/post/edit/${this.content.id}` :
                        this.content.type === 'event' ? `/api/events/${this.content.id}` :
                        `/api/announcements/${this.content.id}`;
        const payload = this.content.type === 'post' ? { caption: this.selectedContent.text } :
                       this.content.type === 'event' ? { event_description: this.selectedContent.text } :
                       { description: this.selectedContent.text };
        await axios.put(endpoint, payload);
        this.content = {
          ...this.content,
          [this.content.type === 'post' ? 'caption' : this.content.type === 'event' ? 'event_description' : 'description']: this.selectedContent.text,
          updated_at: new Date().toISOString(),
        };
        this.closeEditModal();
        Swal.fire({
          position: 'bottom-end',
          icon: 'success',
          title: `Your ${this.content.type} has been updated successfully!`,
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          background: '#1e293b',
          color: '#ffffff',
          toast: true,
        });
      } catch (error) {
        console.error('Error updating content:', error);
        Swal.fire({
          position: 'bottom-end',
          icon: 'error',
          title: 'Something went wrong',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          background: '#1e293b',
          color: '#ffffff',
          toast: true,
        });
      }
    },
    openDeleteModal() {
      if (!this.isAuthenticated) {
        this.triggerLoginModal();
        return;
      }
      const modal = document.getElementById('deleteModal');
      if (modal) modal.showModal();
    },
    closeDeleteModal() {
      const modal = document.getElementById('deleteModal');
      if (modal) modal.close();
    },
    async confirmDelete() {
      try {
        const endpoint = this.content.type === 'post' ? `/api/posts/delete/${this.content.id}` :
                        this.content.type === 'event' ? `/api/events/${this.content.id}` :
                        `/api/announcements/${this.content.id}`;
        await axios.delete(endpoint);
        this.$router.push('/'); // Redirect to home or another page
        Swal.fire({
          position: 'bottom-end',
          icon: 'success',
          title: `Your ${this.content.type} has been deleted successfully!`,
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          background: '#1e293b',
          color: '#ffffff',
          toast: true,
        });
      } catch (error) {
        console.error('Error deleting content:', error);
        Swal.fire({
          position: 'bottom-end',
          icon: 'error',
          title: 'Something went wrong',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          background: '#1e293b',
          color: '#ffffff',
          toast: true,
        });
      }
    },
    openReportModal() {
      if (!this.isAuthenticated) {
        this.triggerLoginModal();
        return;
      }
      this.selectedReportId = this.content.id;
    },
    closeReportModal() {
      this.selectedReportId = null;
    },
    async likeContent() {
      if (!this.isAuthenticated) {
        this.triggerLoginModal();
        return;
      }
      try {
        const endpoint = `/api/like/${this.content.id}/${this.content.type}`;
        await axios.post(endpoint);
        this.content.is_liked = !this.content.is_liked;
        this.content.likes_count += this.content.is_liked ? 1 : -1;
      } catch (error) {
        console.error('Error liking/unliking content:', error);
      }
    },
    async likeComment(comment) {
      if (!this.isAuthenticated) {
        this.triggerLoginModal();
        return;
      }
      try {
        // Assuming a comment like endpoint exists
        await axios.post(`/api/like/${comment.comment_id}/comment`);
        comment.is_liked = !comment.is_liked;
        comment.likes_count += comment.is_liked ? 1 : -1;
      } catch (error) {
        console.error('Error liking/unliking comment:', error);
      }
    },
    async bookmarkContent() {
      if (!this.isAuthenticated) {
        this.triggerLoginModal();
        return;
      }
      try {
        const endpoint = `/api/bookmark/${this.content.id}/${this.content.type}`;
        await axios.post(endpoint);
        this.content.is_bookmarked = !this.content.is_bookmarked;
      } catch (error) {
        console.error('Error bookmarking content:', error);
      }
    },
    openCommentsModal() {
      if (!this.isAuthenticated) {
        this.triggerLoginModal();
        return;
      }
      this.isCommentsModalOpen = true;
    },
    closeCommentsModal() {
      this.isCommentsModalOpen = false;
      this.fetchContent(); // Refresh content to update comments
    },
    openAdoptionModal() {
      if (!this.isAuthenticated) {
        this.triggerLoginModal();
        return;
      }
      this.isAdoptionModalOpen = true;
    },
    closeAdoptionModal() {
      this.isAdoptionModalOpen = false;
      this.fetchContent(); // Refresh content to update adoption status
    },
    async submitAdoptionForm(formData) {
      if (!this.isAuthenticated) {
        this.triggerLoginModal();
        return;
      }
      const formDataToSend = new FormData();
      formDataToSend.append('receiver_id', this.content.user_id);
      formDataToSend.append('post_id', this.content.id);
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
        await axios.post('/api/adoption/submit', formDataToSend, {
          headers: { 'Content-Type': 'multipart/form-data' },
        });
        this.content.done_sending_adoption_form = true;
        this.closeAdoptionModal();
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
      } catch (error) {
        console.error('Error submitting adoption form:', error);
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
    triggerLoginModal() {
      this.showLoginModal = true;
      this.$nextTick(() => {
        const loginFirst = this.$refs.loginFirst;
        if (loginFirst) loginFirst.showLoginModal();
      });
    },
  },
  mounted() {
    this.checkAuthentication();
    this.fetchContent();
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
  color: #4a5568;
}
.text-center {
  text-align: center;
}
.text-gray-500 {
  color: #6b7280;
}
.py-4 {
  padding-top: 1rem;
  padding-bottom: 1rem;
}
</style>