<template>
<div v-for="event in events" :key="event.event_id" class="card bg-base-200 w-full shadow-xl my-4 border border-base-300">
    <!-- Header with Title and Menu -->
    <div class="flex flex-row items-end p-4 justify-between align-middle">
        <!-- Dropdown Menu -->
        <div class="flex justify-end w-full">
            <div class="dropdown dropdown-end z-50">
                <label tabindex="0" class="btn btn-sm btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                    <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
                    </svg>
                </label>
                <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-300 rounded-box w-40">
                    <li v-if="event.shelter_id === currentUserId"><a href="#" @click.prevent="editEvent(event)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg>
                    Edit Event
                    </a></li>
                    <li v-if="event.shelter_id === currentUserId"><a href="#" @click.prevent="openDeleteModal(event.event_id)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                    </svg>
                    Delete Event
                    </a></li>
                    <li v-if="event.shelter_id !== currentUserId"><a href="#" @click.prevent="openReportModal(event.event_id)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-flag" viewBox="0 0 16 16">
                        <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21 21 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21 21 0 0 0 14 7.655V1.222z"/>
                    </svg>  
                    Report Event
                    </a></li>
                </ul>
            </div>
        </div>
    </div> 

    <!-- Thumbnail -->
    <div v-if="event.event_thumbnail && event.event_thumbnail.length > 0" class="relative w-full rounded-lg">
        <!-- Slides container -->
        <div class="overflow-hidden rounded-lg">
            <div
            class="flex transition-transform duration-300"
            :style="{ transform: `translateX(-${event.currentSlide * 100}%)` }"
            >
            <div
                v-for="(thumbnail, index) in event.event_thumbnail"
                :key="index"
                class="w-full flex-shrink-0"
            >
                <img
                :src="`/storage/${thumbnail}`"
                :alt="`Event thumbnail ${index + 1}`"
                class="w-full object-cover rounded-lg"
                />
            </div>
            </div>
        </div>

        <!-- Navigation arrows -->
        <div
        v-if="event.event_thumbnail.length > 1"
        class="absolute inset-0 flex items-center justify-between px-4"
        >
        <!-- Left arrow: show only if not on first slide -->
        <button
            v-if="event.currentSlide > 0"
            type="button"
            @click.stop="prevSlide(event)"
            class="btn btn-circle bg-white bg-opacity-50 hover:bg-opacity-70"
        >
            ❮
        </button>

        <!-- Spacer to maintain layout when only one button is visible -->
        <div v-else class="w-10"></div>

        <!-- Right arrow: show only if not on last slide -->
        <button
            v-if="event.currentSlide < event.event_thumbnail.length - 1"
            type="button"
            @click.stop="nextSlide(event)"
            class="btn btn-circle bg-white bg-opacity-50 hover:bg-opacity-70"
        >
            ❯
        </button>

        <!-- Spacer to maintain layout when only one button is visible -->
        <div v-else class="w-10"></div>
        </div>


        <!-- Indicator dots -->
        <div
            v-if="event.event_thumbnail.length > 1"
            class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2"
        >
            <button
            v-for="(_, index) in event.event_thumbnail"
            :key="index"
            @click.stop="goToSlide(event, index)"
            class="w-3 h-3 rounded-full bg-gray-300 hover:bg-gray-400"
            :class="{ 'bg-white': event.currentSlide === index }"
            ></button>
        </div>
    </div>

    <ReportModal v-if="selectedReportEventId" :eventId="selectedReportEventId" :reportType="'event'" :currentUserId="currentUserId" @close="closeReportModal()"/>

    <dialog :id="`editEventModal-${event.event_id}`" class="modal">
        <div class="modal-box w-[90vw] h-[40vh] max-w-2xl">
        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" @click="closeEditModal(event.event_id)">✕</button>
        <h3 class="text-xl font-semibold">Edit Event</h3>
        <form @submit.prevent="submitEditEvent(event.event_id)">
            <div class="my-4">
            <label for="caption" class="label">Title</label>
            <input type="text" v-model="selectedEvent.event_title" id="title" class="textarea textarea-bordered w-full" rows="1"></input>
            <label for="caption" class="label">Description</label>
            <textarea v-model="selectedEvent.event_description" id="description" class="textarea textarea-bordered w-full" rows="3"></textarea>
            </div>
            <div class="modal-action">
            <button class="btn btn-primary">Save Changes</button>
            </div>
        </form>
        </div>
    </dialog>

    <!-- Delete Confirmation Modal -->
    <dialog :id="`deleteEventModal-${event.event_id}`" class="modal">
        <div class="modal-box">
            <h3 class="text-lg f-bold">Are you sure you want to delete this event?</h3>
            <p class="py-4">This action cannot be undone.</p>
            <div class="modal-action">
                <button class="btn btn-error" @click="confirmDelete(event.event_id)">Yes, Delete</button>
                <button class="btn" @click="closeDeleteModal(event.event_id)">Cancel</button>
            </div>
        </div>
    </dialog>

    <!-- Card Body -->
    <div class="card-body">
        <div class="text-base mt-2 relative">
        <h2 class="card-title mb-2 text-3xl">{{ event.event_title }}</h2>
            <!-- Date -->
            <div class="text-xs w-full mb-4">
                <span>From: {{ event.event_start_date }}</span>
                <span class="mx-1">|</span>
                <span>To: {{ event.event_end_date }}</span>
            </div>
            <p class="break-words whitespace-normal text-sm sm:text-base">
                {{ event.expanded ? event.event_description : (event.event_description && event.event_description.length > 135 ? event.event_description.substring(0, 135) + '...' : event.event_description) }}
            </p>
            <button v-if="event.event_description && event.event_description.length > 125" class="btn btn-link btn-xs text-sm mt-2" @click="toggleDescription(event)">
                {{ event.expanded ? 'See Less' : 'See More' }}
            </button>
        </div>
        <div class="flex items-center space-x-3 mt-2">
            <div class="avatar">
                <div class="w-12 h-12 rounded-full">
                    <img :src="`/storage/${event.profile_picture}`" alt="User Avatar">
                </div>
            </div>
            <div>
                <p class="text-sm font-semibold">{{ event.name }}</p>
                <div class="text-xs">
                    <span>{{ event.created_at }}</span>
                    <span class="mx-1">|</span>
                    <span>{{ event.updated_at }}</span>
                </div>
            </div>
        </div>   
        <!-- Buttons -->
        <div class="flex gap-2 flex-wrap">
            <!-- Upvote Button -->
            <button class="btn bg-primary btn-sm text-base-300" @click="likeEvent(event.event_id)">
                <svg
                    v-if="event.is_liked"
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
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <p>{{ event.likes_count }} Like</p>
            </button>
    
            <!-- Comments Button -->
            <button id="commentsBtn" class="btn btn-outline btn-sm flex gap-1 items-center" @click="openModal(event.event_id)">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-5 w-5 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8H7M17 12H7M9 16H15M5 5V19L10 14H19C19.5523 14 20 13.5523 20 13V6C20 5.44772 19.5523 5 19 5H5Z" />
                </svg>
                <span>{{event.comments_count}} Comments</span>
            </button>

            <Comments :isCommentsModalOpen="isCommentsModalOpen" :commentList="comments" @close="closeCommentsModal" :eventId="selectedEventId"/>

            <!-- Bookmark Button -->
            <button @click="isBookmarked(event.event_id)" id="bookmarkBtn" class="btn btn-outline btn-sm flex items-center gap-2">
                <svg v-if="event.is_bookmarked" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmarks-fill" viewBox="0 0 16 16">
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
<div v-else-if="!hasMoreEvents" class="text-center my-4">
    No more events to load
</div>
</template>
<script>
import axios from 'axios';
import Swal from 'sweetalert2';
import Comments from '../misc/Comments.vue';
import ReportModal from '../misc/Reports.vue'

export default {
    components: {
        Comments,
        ReportModal
    },
    props: {
        userId: {
        type: [Number, String],
        required: true
        }
    },
    data(){
        return{
            events: [],
            loading: false,
            hasMoreEvents: true,
            isAuthenticated: false,
            currentUserId: null,
            isCommentsModalOpen: false,
            selectedCommentEventId: null,
            currentPage: 1,
            selectedReportEventId: null,
            selectedEventId: null,
            selectedEvent: {event_title: '', event_description: ''},
            currentSlide: 0,
            scrollListener: null,
        }
    },
    methods: {
        async isBookmarked(eventId) {
            if (!this.isAuthenticated) {
                this.triggerLoginModal();
                return;
            }
            
            try {
                await axios.post(`/api/bookmark/${eventId}/event`);
                
                // Find the post and update its like state
                const event = this.events.find(event => event.event_id === eventId);
                if (event) {
                    event.is_bookmarked = !event.is_bookmarked; // Toggle like state
                }

                // Fetch the updated likes count
                await this.UpdateEvents();
            } catch (error) {
                console.error("Error liking/unliking announcements:", error);
            }
        },
        async UpdateEvents() {
            this.loading = true;
            try {
                const response = await axios.get(`/api/accounts/view/event/${this.userId}`);
                this.posts = response.data.posts || [];
                this.hasMorePosts = !!response.data.pagination.next_page_url;
                this.currentPage = 2; // Reset to next page for subsequent fetches
            } catch (error) {
                console.error('Error fetching user posts:', error);
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
                if (!this.loading && this.hasMoreEvents) {
                this.fetchEvents();
                }
            }
        },
        editEvent(event) {
            this.selectedEvent = { ...event };     // Make sure to copy post data correctly
            const modal = document.getElementById(`editEventModal-${event.event_id}`);
            if (modal) {
                modal.showModal();
            }
        },
        closeEditModal(eventId) {
            const modal = document.getElementById(`editEventModal-${eventId}`);
            if (modal) {
                modal.close();  // This will close the modal
            }
        },
        submitEditEvent() {
            axios.put(`/api/event/edit/${this.selectedEvent.event_id}`, this.selectedEvent, {
                })
                .then(response => {
                    this.UpdateEvents();
                    this.closeEditModal(this.selectedEvent.event_id);  // Close the modal after success
                    
                    Swal.fire({
                        position: "bottom-end",
                        icon: "success",
                        title: "Your Event has been updated successfully!",
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
                    console.error('Error updating Announcement:', error);
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
        openDeleteModal(eventId) {
            const modal = document.getElementById(`deleteEventModal-${eventId}`);
            if (modal) {
                modal.showModal();
            }
        },
        closeDeleteModal(eventId) {
            const modal = document.getElementById(`deleteEventModal-${eventId}`);
            if (modal) {
                modal.close();
            }
        },
        confirmDelete(eventId) {
            axios.delete(`/api/event/delete/${eventId}`)
                .then(response => {
                    this.UpdateEvents();
                    this.closeDeleteModal(eventId);

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
                    console.error("Error deleting event:", error);

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
        nextSlide(event) {
            if (event.currentSlide < event.event_thumbnail.length - 1) {
                event.currentSlide++;
            } else {
                event.currentSlide = 0;
            }
        },
        prevSlide(event) {
            if (event.currentSlide > 0) {
                event.currentSlide--;
            } else {
                event.currentSlide = event.event_thumbnail.length - 1;
            }
        },
        goToSlide(event, index) {
            event.currentSlide = index;
        },
        openModal(eventId) {
            this.isCommentsModalOpen = true;
            this.fetchComments(eventId);  // Fetch comments for the selected post  
            this.selectedEventId = eventId;
        },
        closeCommentsModal() {
            this.isCommentsModalOpen = false;
            this.comments = [];  // Clear comments when modal is closed
            this.UpdateEvents();
        },
        async fetchComments(eventId) {
            try {
                const response = await axios.get(`/api/comments/${eventId}/event`);
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
        async likeEvent(eventId) {
            if(!this.isAuthenticated){
                this.triggerLoginModal();
                return;
            }
            try {
                await axios.post(`/api/like/${eventId}/event`);
                
                // Find the post and update its like state
                const event = this.events.find(event => event.event_id === eventId);
                if (event) {
                    event.is_liked = !event.is_liked; // Toggle like state
                }

                // Fetch the updated likes count
                await this.fetchLikesCount(eventId);
            } catch (error) {
                console.error("Error liking/unliking event:", error);
            }
        },
        async fetchLikesCount(eventId, type = 'event') {
            try {
                const response = await axios.get(`/api/like-count/${eventId}/${type}`);
                const event = this.events.find(ev => ev.event_id === eventId);
                if (event) {
                    event.likes_count = response.data.likesCount; // Update likes count
                }
            } catch (error) {
                console.error("Error fetching likes count:", error);
            }
        },
        async fetchEvents(initialLoad = false) {
            if (this.loading || !this.hasMoreEvents) return;
            this.loading = true;
            try {
                const response = await axios.get(`/api/accounts/view/event/${this.userId}?page=${this.currentPage}`);
                if (initialLoad) {
                this.events = response.data.events || [];
                } else {
                this.events = [...this.events, ...response.data.events];
                }
                this.hasMoreEvents = !!response.data.pagination.next_page_url;
                this.currentPage++;
            } catch (error) {
                console.error("Error fetching :", error);
            } finally {
                this.loading = false;
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
        this.fetchEvents();
        this.checkAuthentication();
        this.scrollListener = this.handleScroll.bind(this);
        window.addEventListener('scroll', this.scrollListener);
    },
    beforeUnmount() {
        if (this.scrollListener) {
            window.removeEventListener('scroll', this.scrollListener);
        }
    }
}
</script>