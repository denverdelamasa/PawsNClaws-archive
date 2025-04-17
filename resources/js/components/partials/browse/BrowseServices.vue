<template>
<div class="h-full w-full bg-base-100 overflow-auto gap-4 p-6">
  <!-- Services Section -->
  <div class="flex flex-col m-2 p-2">
    <!-- Header -->
    <div class="flex gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-12 h-12" viewBox="0 0 16 16">
        <path d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.707L8 2.207 1.354 8.853a.5.5 0 1 1-.708-.707z"/>
        <path d="m14 9.293-6-6-6 6V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5zm-6-.811c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.691 0-5.018"/>
      </svg>
      <div>
        <h2 class="text-5xl font-bold">Services</h2>
      </div>
    </div>
    <p class="text-lg mt-2">Discover comprehensive pet care services from trusted providers in your area.</p>
    <!-- Content -->
    <div v-if="loading" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Skeleton Loading -->
      <div v-for="i in 3" :key="i" class="card bg-base-200 h-96 animate-pulse">
        <div class="h-48 bg-base-300 rounded-t-box"></div>
        <div class="card-body">
          <div class="h-6 bg-base-300 rounded-box w-3/4"></div>
          <div class="space-y-2">
            <div class="h-4 bg-base-300 rounded-box"></div>
            <div class="h-4 bg-base-300 rounded-box w-5/6"></div>
            <div class="h-4 bg-base-300 rounded-box w-2/3"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Results -->
    <template v-else>
      <div v-if="shelters.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Shelter Cards -->
        <div v-for="shelter in shelters" :key="shelter.user_id" class="card bg-base-200 shadow-lg hover:scale-105 transition-transform duration-200">
          <figure class="relative h-48">
            <img :src="`/storage/${shelter.profile_picture}`" 
                 class="w-full h-full object-cover rounded-t-box"
                 :alt="shelter.name + ' profile picture'">
            <div class="absolute top-2 right-2 badge badge-accent" 
                 v-if="shelter.is_online">
              Online Now
            </div>
          </figure>
          <div class="card-body">
            <h2 class="card-title">{{ shelter.name }}</h2>
            <p class="line-clamp-3 text-base-content/80">
              {{ shelter.bio || 'No description available' }}
            </p>
            <div class="card-actions justify-end mt-4">
              <button class="btn btn-primary gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                  <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                  <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                </svg>
                View Profile
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- No Results -->
      <div v-else class="text-center py-12">
        <div class="text-4xl mb-4">🐾</div>
        <h3 class="text-xl font-semibold text-base-content/80">
          No services found <span v-if="searchQuery">for "{{ searchQuery }}"</span>
        </h3>
        <p class="text-base-content/60 mt-2">Try adjusting your search terms</p>
      </div>

      <!-- Load More -->
      <div v-if="hasMore" class="flex justify-center mt-8">
        <button @click="loadMore" 
                class="btn btn-outline btn-primary gap-2"
                :disabled="loading">
          Load More
          <svg v-if="!loading" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M12 6l0 -3" />
            <path d="M16.25 7.75l2.15 -2.15" />
            <path d="M18 12l3 0" />
            <path d="M16.25 16.25l2.15 2.15" />
            <path d="M12 18l0 3" />
            <path d="M7.75 16.25l-2.15 2.15" />
            <path d="M6 12l-3 0" />
            <path d="M7.75 7.75l-2.15 -2.15" />
          </svg>
          <span v-else class="loading loading-spinner"></span>
        </button>
      </div>
    </template>
  </div>
</div>
</template>

<script>
import axios from 'axios';

export default {
    name: "browseServices",
    props: ['searchQuery'],
    data () {
        return {
            shelters: [],
            currentPage: 1,
            totalPages: 1,
            hasMore: false,
            loading: false
        }
    },
    watch: {
        searchQuery(newVal) {
            this.currentPage = 1;
            this.shelters = [];
            this.fetchBrowseShelters(newVal);
        },
    },
    methods: {
        loadMore() {
            this.currentPage += 1;
            this.fetchBrowseShelters(this.searchQuery);
        },
        fetchBrowseShelters(search = '') {
            this.loading = true;
            axios.get('/api/browse/shelters', {
                params: { 
                    search,
                    page: this.currentPage
                }
            })
            .then(response => {
                if (this.currentPage === 1) {
                    this.shelters = response.data.data;
                } else {
                    this.shelters = [...this.shelters, ...response.data.data];
                }
                
                this.totalPages = response.data.last_page;
                this.hasMore = this.currentPage < this.totalPages;
            })
            .catch(error => {
                console.error('Error fetching shelters:', error);
            })
            .finally(() => {
                this.loading = false;
            });
        },
    },
    mounted () {
        this.fetchBrowseShelters(this.searchQuery);
    }
}
</script>