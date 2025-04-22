<template>
<div class="h-full w-full bg-base-100 overflow-auto gap-4 lg:p-6 p-0">
    <!-- Users -->
    <div class="flex flex-col m-2 p-2 border-base-300">
        <div class="flex gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-12 h-12" viewBox="0 0 16 16">
                <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6m5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1z"/>
            </svg>
            <div>
                <h2 class="text-5xl font-bold">Accounts</h2>
            </div>
        </div>
        <p class="text-lg mt-2">Explore user accounts and connect with the community.</p>
        
        <!-- Loading Overlay -->
        <div v-if="loading" class="relative flex w-64 animate-pulse gap-2 p-4">
            <div class="h-12 w-12 rounded-full bg-slate-400"></div>
            <div class="flex-1">
                <div class="mb-1 h-5 w-3/5 rounded-lg bg-slate-400 text-lg"></div>
                <div class="h-5 w-[90%] rounded-lg bg-slate-400 text-sm"></div>
            </div>
            <div class="absolute bottom-5 right-0 h-4 w-4 rounded-full bg-slate-400"></div>
        </div>
        
        <div v-if="users.length === 0 && searchQuery && !loading" class="text-center p-4">
            <div class="text-4xl mb-4">😿</div>
            <h3 class="text-xl font-semibold text-base-content/80">
                No accounts found <span v-if="searchQuery">for "{{ searchQuery }}"</span>
            </h3>
            <p class="text-base-content/60 mt-2">Try different search terms</p>
        </div>

        <div v-else>
            <div v-for="user in users" :key="user.user_id" class="mt-6 flex flex-row card card-side bg-base-200 shadow-sm px-4 hover:scale-105 transition-transform duration-200">
                <figure class="m-auto w-16 h-16 rounded-full overflow-hidden">
                    <img
                        :src="`/storage/${user.profile_picture}`"
                        alt="User Avatar"
                        class="w-full h-full object-cover" />
                </figure>
                <div class="card-body p-4">
                    <h2 class="card-title">{{ user.name }}</h2>
                    <p class="truncate">{{ user.bio || 'No bio available' }}</p>
                    <!-- Inde ko alam kung pano yung mag ccut sya pag over flow yung naka "..." yung dulo? inde ko alam HAGSHAHA  -->
                    <ul class="flex flex-wrap gap-x-2 gap-y-2">
                        <div v-if="user.role === 'Shelter'" class="badge badge-accent">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4" viewBox="0 0 16 16">
                                <path d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.707L8 2.207 1.354 8.853a.5.5 0 1 1-.708-.707z"/>
                                <path d="m14 9.293-6-6-6 6V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5zm-6-.811c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.691 0-5.018"/>
                            </svg>
                            Shelter Account
                        </div>
                    </ul>
                </div>
                <!-- View Profile Account --> 
                <button @click="viewProfile(user.user_id)" class="AccountBrowseViewButton m-auto max-w-12 hover:scale-105 transition-all duration-100">View</button>
            </div>
            <!--Load More-->
            <div v-if="hasMore" class="text-center mt-4">
                <button @click="loadMore" class="btn btn-accent">Load More</button>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import axios from 'axios';

export default {
    name: "browseAccounts",
    props: ['searchQuery'], // Add props
    data() {
        return {
            users: [],
            currentPage: 1,
            totalPages: 1,
            hasMore: false,
            loading: false // Add loading state
        }
    },
    watch: {
        searchQuery(newVal) {
            this.currentPage = 1;
            this.users = [];
            this.fetchBrowseUsers(newVal);
        },
    },
    methods: {
        viewProfile(userId) {
            console.log('Navigating to profile with userId:', userId);
            window.location.href = `/browse/view?user_id=${userId}`;
        },
        fetchBrowseUsers(search = '') {
            this.loading = true; // Show loader when starting request
            axios.get('/api/browse/accounts', {
                params: { 
                    search,
                    page: this.currentPage
                }
            })
            .then(response => {
                // Append new results or replace if first page
                if (this.currentPage === 1) {
                    this.users = response.data.data;
                } else {
                    this.users = [...this.users, ...response.data.data];
                }
                
                this.totalPages = response.data.last_page;
                this.hasMore = this.currentPage < this.totalPages;
            })
            .catch(error => {
                console.error('Error fetching users:', error);
            })
            .finally(() => {
                this.loading = false; // Hide loader when done
            });
        },
        loadMore() {
            this.currentPage++;
            this.fetchBrowseUsers(this.searchQuery);
        }
    },
    mounted() {
        this.fetchBrowseUsers(this.searchQuery);
    }
}

</script>

<style>
.truncate {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    max-width: 200px; /* Adjust as needed */
}
/* Add spinner animation */
.loadMore {
    width: 165px;
    height: 62px;
    cursor: pointer;
    color: #fff;
    font-size: 17px;
    border-radius: 1rem;
    border: none;
    position: relative;
    transition: 0.1s;
}

.loadMore::after {
    content: '';
    width: 100%;
    height: 100%;
    background-image: radial-gradient( circle farthest-corner at 10% 20%,  rgba(255,94,247,1) 17.8%, rgba(2,245,255,1) 100.2% );
    filter: blur(15px);
    z-index: -1;
    position: absolute;
    left: 0;
    top: 0;
}

.loadMore:active {
    transform: scale(0.9) rotate(3deg);
    background: radial-gradient( circle farthest-corner at 10% 20%,  rgba(255,94,247,1) 17.8%, rgba(2,245,255,1) 100.2% );
    transition: 0.5s;
}

/* From Uiverse.io by kirzin */ 
.AccountBrowseViewButton {
    text-decoration: none;
    position: relative;
    border: none;
    font-size: 14px;
    font-family: inherit;
    cursor: pointer;
    color: #fff;
    width: 9em;
    height: 3em;
    line-height: 2em;
    text-align: center;
    background: linear-gradient(90deg, #03a9f4, #f441a5, #ffeb3b, #03a9f4);
    background-size: 300%;
    border-radius: 30px;
    z-index: 1;
}

.AccountBrowseViewButton:hover {
    animation: ani 8s linear infinite;
    border: none;
}

@keyframes ani {
0% {
    background-position: 0%;
}

100% {
    background-position: 400%;
}
}

.AccountBrowseViewButton:before {
    content: "";
    position: absolute;
    top: -5px;
    left: -5px;
    right: -5px;
    bottom: -5px;
    z-index: -1;
    background: linear-gradient(90deg, #03a9f4, #f441a5, #ffeb3b, #03a9f4);
    background-size: 400%;
    border-radius: 35px;
    transition: 1s;
}

.AccountBrowseViewButton:hover::before {
    filter: blur(20px);
}

.AccountBrowseViewButton:active {
    background: linear-gradient(32deg, #03a9f4, #f441a5, #ffeb3b, #03a9f4);
}
</style>