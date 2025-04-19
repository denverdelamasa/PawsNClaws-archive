<template>
<div class="bg-base-200">
    <div class="container mx-auto py-8">
        <div v-if="loading" class="text-center p-8">
            <div class="loading loading-spinner loading-lg"></div>
            <p class="mt-4">Loading profile...</p>
        </div>

        <div v-else-if="error" class="alert alert-error mx-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ error }}</span>
        </div>

        <!-- In ViewAccount.vue template -->
        <div v-else-if="!user" class="text-center p-8">
            <div class="text-4xl mb-4">😿</div>
            <h3 class="text-xl font-semibold">User not found</h3>
        </div>

        <div v-else class="grid grid-cols-4 sm:grid-cols-12 gap-6 px-4">
            <!-- Profile Card -->
            <div class="col-span-4 sm:col-span-3 sticky">
                <div class="bg-base-100 shadow-lg rounded-lg p-6">
                    <div class="flex flex-col items-center">
                        <img :src="`/storage/${user.profile_picture}`" 
                             class="w-32 h-32 bg-base-300 rounded-full mb-4" 
                             :alt="`${user.name}'s avatar`">
                        <div class="flex flex-row gap-x-2 align-middle items-center justify-center">
                            <h1 class="text-xl font-bold">{{ user.name }}</h1>
                        </div>
                        
                        <p class="text-base-content/70">{{ user.role }}</p>
                    </div>
                    <hr class="my-6 border-t border-base-300">
                    
                    <!-- Badges Section -->
                    <div class="flex flex-col">
                        <span class="text-base-content uppercase font-bold tracking-wider mb-2">Badges</span>
                        <ul class="flex flex-wrap gap-x-2 gap-y-2">
                            <!-- Example conditional badge - modify based on your user data -->
                            <div v-if="user.role === 'Shelter'" class="badge badge-accent">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4" viewBox="0 0 16 16">
                                    <path d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.707L8 2.207 1.354 8.853a.5.5 0 1 1-.708-.707z"/>
                                    <path d="m14 9.293-6-6-6 6V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5zm-6-.811c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.691 0-5.018"/>
                                </svg>
                                Shelter Account
                            </div>
                            <div v-if="user.role === 'Foster'" class="badge badge-info">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4" viewBox="0 0 16 16">
                                    <!-- Foster icon -->
                                </svg>
                                Foster Parent
                            </div>
                            <!-- Add more conditional badges as needed -->
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-span-4 sm:col-span-9 flex gap-y-4 flex-col">
                <div class="bg-base-100 shadow-lg rounded-lg p-6">
                    <div class="flex flex-row gap-x-2 align-middle items-center justify-left">
                        <h1 class="text-xl font-bold">Information</h1>
                    </div>
                    <div class="space-y-4 mt-4">
                        <div>
                            <p class="text-base-content/70 text-sm">Bio:</p>
                            <p class="text-base-content">{{ user.bio || "No Available Bio" }}</p>
                        </div>
                    </div>
                </div>

                <!-- Dynamic Content Tabs -->
                <div class="p-2 flex flex-row gap-x-4">
                    <button class="text-xl font-bold hover:scale-105 transition-all duration-100"
                            :class="{ 'text-primary': activeTab === 'posts' }"
                            @click="activeTab = 'posts'">
                        Posts
                    </button>
                    <button v-if="user.role === 'Shelter' && 'Admin'" 
                            class="text-xl font-bold hover:scale-105 transition-all duration-100"
                            :class="{ 'text-primary': activeTab === 'announcements' }"
                            @click="activeTab = 'announcements'">
                        Announcements
                    </button>
                    <button v-if="user.role === 'Shelter' && 'Admin'" class="text-xl font-bold hover:scale-105 transition-all duration-100"
                            :class="{ 'text-primary': activeTab === 'events' }"
                            @click="activeTab = 'events'">
                        Events
                    </button>
                </div>

                <!-- Tab Content -->
                <div class="bg-base-100 shadow-lg rounded-lg p-6">
                    <div v-if="activeTab === 'posts'">
                        <!-- Posts content -->
                        <p>User posts will be displayed here</p>
                    </div>
                    <div v-else-if="activeTab === 'announcements'">
                        <!-- Announcements content -->
                        <p>Shelter announcements will be displayed here</p>
                    </div>
                    <div v-else-if="activeTab === 'events'">
                        <!-- Events content -->
                        <p>Upcoming events will be displayed here</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'ViewAccount',
    props: {
        userId: {
            type: [String, Number],
            required: true,
        }
    },
    data() {
        return {
            user: null,
            loading: true,
            error: null,
            activeTab: 'posts'
        }
    },
    created() {
        this.fetchUserData();
    },
    methods: {
        async fetchUserData() {
            try {
                const response = await axios.get(`/api/accounts/view/${this.userId}`);
                this.user = response.data.user;
            } catch (error) {
                this.error = error.response?.data.message || 'Failed to load user profile';
                console.error('Error fetching user:', error);
            } finally {
                this.loading = false;
            }
        }
    }
}
</script>