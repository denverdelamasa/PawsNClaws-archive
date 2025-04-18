<template>
  <div>
    <div class="drawer lg:drawer-open">
      <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
      <div class="drawer-content flex flex-col">
        <div class="w-full px-6 flex flex-row gap-x-2 mt-4">
          <!-- DropDown Functionality -->
          <div class="dropdown dropdown-bottom">
            <div tabindex="0" role="button" class="btn btn-md flex items-center">
              Filter
            </div>
            <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-50 w-52 p-2 shadow gap-2">
              <li><a>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 16 16">
                  <path d="M2.5 3a.5.5 0 0 0 0 1h11a.5.5 0 0 0 0-1zm5 3a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm-5 3a.5.5 0 0 0 0 1h11a.5.5 0 0 0 0-1zm.79-5.373q.168-.117.444-.275L3.524 6q-.183.111-.452.287-.27.176-.51.428a2.4 2.4 0 0 0-.398.562Q2 7.587 2 7.969q0 .54.217.873.217.328.72.328.322 0 .504-.211a.7.7 0 0 0 .188-.463q0-.345-.211-.521-.205-.182-.568-.182h-.282q.036-.305.123-.498a1.4 1.4 0 0 1 .252-.37 2 2 0 0 1 .346-.298zm2.167 0q.17-.117.445-.275L5.692 6q-.183.111-.452.287-.27.176-.51.428a2.4 2.4 0 0 0-.398.562q-.165.31-.164.692 0 .54.217.873.217.328.72.328.322 0 .504-.211a.7.7 0 0 0 .188-.463q0-.345-.211-.521-.205-.182-.568-.182h-.282a1.8 1.8 0 0 1 .118-.492q.087-.194.257-.375a2 2 0 0 1 .346-.3z"/>
                </svg>
                Relevance
              </a></li>
              <li><a>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M11.5 1.246c.832-.855 2.913.642 0 2.566-2.913-1.924-.832-3.421 0-2.566M9 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h10s1 0 1-1-1-4-6-4-6 3-6 4m13.5-8.09c1.387-1.425 4.855 1.07 0 4.277-4.854-3.207-1.387-5.702 0-4.276ZM15 2.165c.555-.57 1.942.428 0 1.711-1.942-1.283-.555-2.281 0-1.71Z"/>
                </svg>
                Engagement
              </a></li>
              <li><a>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 16 16">
                  <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.724-.69q.406.429.747.91zm.744 1.352a7 7 0 0 0-.214-.468l.893-.45a8 8 0 0 1 .45 1.088l-.95.313a7 7 0 0 0-.179-.483m.53 2.507a7 7 0 0 0-.1-1.025l.985-.17q.1.58.116 1.17zm-.131 1.538q.05-.254.081-.51l.993.123a8 8 0 0 1-.23 1.155l-.964-.267q.069-.247.12-.501m-.952 2.379q.276-.436.486-.908l.914.405q-.24.54-.555 1.038zm-.964 1.205q.183-.183.35-.378l.758.653a8 8 0 0 1-.401.432z"/>
                  <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z"/>
                  <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5"/>
                </svg>
                Recent
              </a></li>
            </ul>
          </div>
          <div class="flex gap-2 w-full">
            <div class="w-full relative">
              <!-- Search automatic na magsshow -->
              <input type="text" placeholder="Search" v-model="tempSearch" @keyup.enter="triggerSearch" @input="handleSearchInput" class="input input-bordered border-base-100 input-accent w-full bg-base-200"/>
            </div>
          </div>
          <button @click="triggerSearch" class="btn btn-accent">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </button>
        </div>
        <!-- Content Section -->
        <div class="mainBrowseContent">
          <div v-if="browseContent === 'browseAll'">
            <browseAll :searchQuery="searchQuery"/>
          </div>
          <div v-if="browseContent === 'browsePosts'">
            <browsePosts :searchQuery="searchQuery"/>
          </div>
          <div v-if="browseContent === 'browseAnnouncements'">
            <browseAnnouncements :searchQuery="searchQuery"/>
          </div>
          <div v-if="browseContent === 'browseEvents'">
            <browseEvents :searchQuery="searchQuery"/>
          </div>
          <div v-if="browseContent === 'browseServices'">
            <browseServices :searchQuery="searchQuery"/>
          </div>
          <div v-if="browseContent === 'browseAccounts'">
            <browseAccounts :searchQuery="searchQuery"/>
          </div>
        </div>

      </div>
      <div class="drawer-side hide-scrollbar">
        <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
        <ul class="menu bg-base-200 text-base-content min-h-full w-80 px-4 py-8 flex flex-col gap-4 z-50">
          <h6 class="text-2xl">Search Filter:</h6>
          <li>  
            <a 
              @click="changeContent('browseAll')" 
              :class="{'active': browseContent === 'browseAll', 'text-content': browseContent !== 'browseAll'}"
            >
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list-columns-reverse" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M0 .5A.5.5 0 0 1 .5 0h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 .5m4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10A.5.5 0 0 1 4 .5m-4 2A.5.5 0 0 1 .5 2h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m4 0a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m-4 2A.5.5 0 0 1 .5 4h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m-4 2A.5.5 0 0 1 .5 6h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5m-4 2A.5.5 0 0 1 .5 8h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5m-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5m-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m4 0a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5"/>
            </svg>
            All
          </a></li>
          <li>
            <a 
              @click="changeContent('browsePosts')" 
              :class="{'active': browseContent === 'browsePosts', 'text-content': browseContent !== 'browsePosts'}"
            >
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-postcard-fill" viewBox="0 0 16 16">
              <path d="M11 8h2V6h-2z"/>
              <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm8.5.5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0zM2 5.5a.5.5 0 0 0 .5.5H6a.5.5 0 0 0 0-1H2.5a.5.5 0 0 0-.5.5M2.5 7a.5.5 0 0 0 0 1H6a.5.5 0 0 0 0-1zM2 9.5a.5.5 0 0 0 .5.5H6a.5.5 0 0 0 0-1H2.5a.5.5 0 0 0-.5.5m8-4v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5"/>
            </svg>
            Posts
          </a></li>
          <li>
            <a 
              @click="changeContent('browseAnnouncements')" 
              :class="{'active': browseContent === 'browseAnnouncements', 'text-content': browseContent !== 'browseAnnouncements'}"
            >
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-megaphone-fill" viewBox="0 0 16 16">
              <path d="M13 2.5a1.5 1.5 0 0 1 3 0v11a1.5 1.5 0 0 1-3 0zm-1 .724c-2.067.95-4.539 1.481-7 1.656v6.237a25 25 0 0 1 1.088.085c2.053.204 4.038.668 5.912 1.56zm-8 7.841V4.934c-.68.027-1.399.043-2.008.053A2.02 2.02 0 0 0 0 7v2c0 1.106.896 1.996 1.994 2.009l.496.008a64 64 0 0 1 1.51.048m1.39 1.081q.428.032.85.078l.253 1.69a1 1 0 0 1-.983 1.187h-.548a1 1 0 0 1-.916-.599l-1.314-2.48a66 66 0 0 1 1.692.064q.491.026.966.06"/>
            </svg>
            Announcements
          </a></li>
          <li>
            <a 
              @click="changeContent('browseEvents')" 
              :class="{'active': browseContent === 'browseEvents', 'text-content': browseContent !== 'browseEvents'}"
            >
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-calendar-week-fill" viewBox="0 0 16 16">
              <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2M9.5 7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m3 0h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5M2 10.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5"/>
            </svg>
            Events
          </a></li>
          <li>
            <a 
              @click="changeContent('browseServices')" 
              :class="{'active': browseContent === 'browseServices', 'text-content': browseContent !== 'browseServices'}"
            >
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-house-heart-fill" viewBox="0 0 16 16">
              <path d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.707L8 2.207 1.354 8.853a.5.5 0 1 1-.708-.707z"/>
              <path d="m14 9.293-6-6-6 6V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5zm-6-.811c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.691 0-5.018"/>
            </svg>
            Services
          </a></li>
          <li>
            <a 
              @click="changeContent('browseAccounts')" 
              :class="{'active': browseContent === 'browseAccounts', 'text-content': browseContent !== 'browseAccounts'}"
            >
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-badge-fill" viewBox="0 0 16 16">
              <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6m5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1z"/>
            </svg>
            Accounts
          </a></li>
          
          <footer class="absolute bottom-4 bg-base-300 text-base-content p-4 text-xs flex flex-row gap-x-4 justify-between rounded-xl border border-base-300">
            <nav class="flex flex-col gap-y-2">
              <h6 class="footer-title text-xs">Contents</h6>
              <a class="link link-hover">Posts</a>
              <a class="link link-hover">Announcements</a>
              <a class="link link-hover">Events</a>
              <a class="link link-hover">Services</a>
            </nav>
            <nav class="flex flex-col gap-y-2">
              <h6 class="footer-title text-xs">Site</h6>
              <a class="link link-hover">About us</a>
              <a class="link link-hover">Contact</a>
              <a class="link link-hover">Apply</a>
            </nav>
            <nav class="flex flex-col gap-y-2">
              <h6 class="footer-title text-xs">Legal</h6>
              <a class="link link-hover" href="{{ url('terms-of-service') }}">Terms of Service</a>
              <a class="link link-hover" href="{{ url('privacy-policy') }}">Privacy policy</a>
            </nav>
          </footer>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import browseAll from './BrowseAll.vue';
import browseAccounts from './BrowseAccounts.vue';
import browseAnnouncements from './browseAnnouncements.vue';
import browseEvents from './BrowseEvents.vue';
import browsePosts from './BrowsePosts.vue';
import browseServices from './BrowseServices.vue';

export default {
  components: {
    browseAll,
    browseAccounts,
    browseAnnouncements,
    browseEvents,
    browsePosts,
    browseServices,
  },
  data() {
    return {
      searchQuery: '',
      tempSearch: '',
      browseContent: 'browseAll', // Example default state
      loading: false,             // Loading state
      browseAll: '',              // Content for browseAll
      browsePosts: '',            // Content for browsePosts
      browseAnnouncements: '',    // Content for browseAnnouncements
      browseEvents: '',           // Content for browseEvents
      browseServices: '',         // Content for browseServices
      browseAccounts: '',          // Content for browseAccounts
      searchSuggestions: [],
      showSuggestions: false,
      debounceTimeout: null
    };
  },
  methods: {
    handleSearchInput() {
      this.showSuggestions = true;
      clearTimeout(this.debounceTimeout);
      this.debounceTimeout = setTimeout(() => {
        if (this.tempSearch.length > 0) {
          this.fetchSearchSuggestions();
        } else {
          this.searchSuggestions = [];
        }
      }, 300);
    },
    async fetchSearchSuggestions() {
      try {
        const response = await axios.get('/api/browse/accounts', {
          params: {
            search: this.tempSearch,
            page: 1,
            perPage: 5 // Limit suggestions to 5 results
          }
        });
        this.searchSuggestions = response.data.data;
      } catch (error) {
        console.error('Error fetching suggestions:', error);
      }
    },

    selectSuggestion(user) {
      this.tempSearch = user.name;
      this.triggerSearch();
      this.showSuggestions = false;
    },

    triggerSearch() {
      this.showSuggestions = false;
      this.searchQuery = this.tempSearch;
      // Add click-outside handler
      document.addEventListener('click', this.handleClickOutside);
    },

    handleClickOutside(event) {
      if (!this.$el.contains(event.target)) {
        this.showSuggestions = false;
      }
    },
    triggerSearch() {
      this.searchQuery = this.tempSearch;
    },
    changeContent(content) {
      this.browseContent = content;  // Change content dynamically
    },
    fetchContent(content) {
      this.loading = true;  // Set loading to true when fetching content
      axios.get(`/api/partial/containers/browse/${content}`)
        .then((response) => {
          // Dynamically assign the HTML response to the respective variable
          this[content] = response.data;
        })
        .catch((error) => {
          console.error('Error loading content:', error);
        })
        .finally(() => {
          this.loading = false;  // Set loading to false after fetching content
        });
    }
  },
  watch: {
    browseContent(newContent) {
      this.fetchContent(newContent);  // Fetch new content whenever browseContent changes
    }
  },
  mounted() {
    this.fetchContent(this.browseContent);  // Load initial content on mount
  },
  beforeDestroy() {
    document.removeEventListener('click', this.handleClickOutside);
  }
};

</script>

<style scoped>
/* Add transition for smoother dropdown appearance */
.dropdown-enter-active,
.dropdown-leave-active {
  transition: all 0.2s ease;
}

.dropdown-enter-from,
.dropdown-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}
</style>