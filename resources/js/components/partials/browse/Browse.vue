<template>
  <div>
    <div class="drawer lg:drawer-open">
      <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
      <div class="drawer-content flex flex-col items-center justify-center">
        <div class="w-full px-6 flex flex-row gap-x-2 mt-4">

          <!-- DropDown Functionality -->
          <div class="dropdown dropdown-bottom">
            <div tabindex="0" role="button" class="btn btn-md flex items-center">
              Filter
            </div>
            <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-50 w-52 p-2 shadow">
              <li><a>
                By Latest
              </a></li>
              <li><a>
                By Likes
              </a></li>
              <li><a>
                Nearest
              </a></li>
            </ul>
          </div>
          <!-- Search automatic na magsshow -->
          <input type="text" placeholder="Search" class="input input-bordered border-base-100 input-accent w-full bg-base-200"/>
        </div>
        <!-- Content Section -->
        <div class="mainBrowseContent">
          <div v-if="loading" class="text-center flex flex-wrap justify-center">
            <!-- From Uiverse.io by Nawsome -->
            <div class="feed-loader bg-base-100 rounded-xl border border-base-300 m-4">
              <div class="wrapper">
                <div class="circle bg-base-200"></div>
                <div class="line-1 bg-base-200"></div>
                <div class="line-2 bg-base-200"></div>
                <div class="line-3 bg-base-200"></div>
                <div class="line-4 bg-base-200"></div>
              </div>
            </div>
          </div> 
          
          <div v-if="browseContent === 'browseAll'">
            <div v-html="browseAll"></div> 
          </div>
          <div v-if="browseContent === 'browsePosts'">
            <div v-html="browsePosts"></div>
          </div>
          <div v-if="browseContent === 'browseAnnouncements'">
            <div v-html="browseAnnouncements"></div>
          </div>
          <div v-if="browseContent === 'browseEvents'">
            <div v-html="browseEvents"></div>
          </div>
          <div v-if="browseContent === 'browseShelters'">
            <div v-html="browseShelters"></div>
          </div>
          <div v-if="browseContent === 'browseAccounts'">
            <div v-html="browseAccounts"></div>
          </div>
        </div>

      </div>
      <div class="drawer-side hide-scrollbar">
        <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
        <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4 flex flex-col gap-4 z-50">
          <h6 class="text-xl">Search Filter:</h6>
          <li><a @click="changeContent('browseAll')">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list-columns-reverse" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M0 .5A.5.5 0 0 1 .5 0h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 .5m4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10A.5.5 0 0 1 4 .5m-4 2A.5.5 0 0 1 .5 2h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m4 0a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m-4 2A.5.5 0 0 1 .5 4h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m-4 2A.5.5 0 0 1 .5 6h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5m-4 2A.5.5 0 0 1 .5 8h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5m-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5m-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m4 0a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5"/>
            </svg>
            All
          </a></li>
          <li><a @click="changeContent('browsePosts')">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-postcard-fill" viewBox="0 0 16 16">
              <path d="M11 8h2V6h-2z"/>
              <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm8.5.5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0zM2 5.5a.5.5 0 0 0 .5.5H6a.5.5 0 0 0 0-1H2.5a.5.5 0 0 0-.5.5M2.5 7a.5.5 0 0 0 0 1H6a.5.5 0 0 0 0-1zM2 9.5a.5.5 0 0 0 .5.5H6a.5.5 0 0 0 0-1H2.5a.5.5 0 0 0-.5.5m8-4v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5"/>
            </svg>
            Posts
          </a></li>
          <li><a @click="changeContent('browseAnnouncements')">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-megaphone-fill" viewBox="0 0 16 16">
              <path d="M13 2.5a1.5 1.5 0 0 1 3 0v11a1.5 1.5 0 0 1-3 0zm-1 .724c-2.067.95-4.539 1.481-7 1.656v6.237a25 25 0 0 1 1.088.085c2.053.204 4.038.668 5.912 1.56zm-8 7.841V4.934c-.68.027-1.399.043-2.008.053A2.02 2.02 0 0 0 0 7v2c0 1.106.896 1.996 1.994 2.009l.496.008a64 64 0 0 1 1.51.048m1.39 1.081q.428.032.85.078l.253 1.69a1 1 0 0 1-.983 1.187h-.548a1 1 0 0 1-.916-.599l-1.314-2.48a66 66 0 0 1 1.692.064q.491.026.966.06"/>
            </svg>
            Announcements
          </a></li>
          <li><a @click="changeContent('browseEvents')">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-calendar-week-fill" viewBox="0 0 16 16">
              <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2M9.5 7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m3 0h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5M2 10.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5"/>
            </svg>
            Events
          </a></li>
          <li><a @click="changeContent('browseShelters')">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-house-heart-fill" viewBox="0 0 16 16">
              <path d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.707L8 2.207 1.354 8.853a.5.5 0 1 1-.708-.707z"/>
              <path d="m14 9.293-6-6-6 6V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5zm-6-.811c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.691 0-5.018"/>
            </svg>
            Shelters
          </a></li>
          <li><a @click="changeContent('browseAccounts')">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-badge-fill" viewBox="0 0 16 16">
              <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6m5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1z"/>
            </svg>
            Accounts
          </a></li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      browseContent: 'browseAll', // Example default state
      loading: false,             // Loading state
      browseAll: '',              // Content for browseAll
      browsePosts: '',            // Content for browsePosts
      browseAnnouncements: '',    // Content for browseAnnouncements
      browseEvents: '',           // Content for browseEvents
      browseShelters: '',         // Content for browseShelters
      browseAccounts: ''          // Content for browseAccounts
    };
  },
  methods: {
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
  }
};

</script>

<style scoped>
/* You can add any styles here */
</style>