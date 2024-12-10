<template>
  <div class="dropdown dropdown-end">
    <button tabindex="0" class="btn btn-ghost btn-circle">
      <div class="relative w-fit h-fit bg-gray-600 rounded-lg p-2 flex items-center justify-center cursor-pointer transition duration-200 hover:bg-gray-800 hover:text-white">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="w-6 h-6 text-gray-300 transition duration-200 transform hover:scale-110"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
          />
        </svg>
        <!-- Notification point indicator -->
        <div v-if="notifications.filter(n => !n.read_at).length > 0" class="absolute bottom-1 left-1 w-1.5 h-1.5 bg-green-500 rounded-full flex items-center justify-center">
          <div class="absolute w-px h-px bg-green-500 rounded-full animate-ping"></div>
        </div>
      </div>
    </button>
    <ul
      tabindex="0"
      class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52"
    >
      <li v-if="notifications.length === 0">
        <a href="#">No notifications</a>
      </li>
      <li v-for="(notification, index) in notifications" :key="index">
        <a 
          href="#" 
          :class="{'font-bold': !notification.read_at}"
          @click.prevent="markAsRead(notification)"
        >
          <div>
            <img :src="`/storage/${notification.liker_profile_picture}`" class="w-8 h-8 rounded-full mr-2" />
            <strong>{{ notification.liker_username }}</strong> <strong>{{ notification.type }}</strong>
            <br>
            <span class="text-gray-500">{{ notification.time_ago }}</span>
          </div>
        </a>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: "Notifications",
  data() {
    return {
      notifications: [],
    };
  },
  mounted() {
    this.fetchNotifications();
  },
  methods: {
    async fetchNotifications() {
      try {
        const response = await axios.get('/api/notifications');
        this.notifications = response.data;
      } catch (error) {
        console.error('Error fetching notifications:', error);
      }
    },
    async markAsRead(notification) {
      if (!notification.read_at) {
        try {
          const response = await axios.post(`/api/notifications/mark-as-read/${notification.notification_id}`);
          console.log(response.data.message); // Optionally log server confirmation

          // Update the notification's read status in the local state
          notification.read_at = new Date().toISOString(); // Set `read_at` timestamp
        } catch (error) {
          console.error('Error marking notification as read:', error);
        }
      }
    },
  },
};
</script>

<style scoped>
.font-bold {
  font-weight: bold;
}

.dropdown-end {
  position: relative; /* Ensures it can be positioned in relation to its parent */
  z-index: 10; /* Set a lower z-index to make it appear behind other elements */
}

.indicator {
  z-index: 20; /* Ensure that the notification indicator (badge) stays visible */
}

.dropdown-content {
  position: absolute; /* Position it within the dropdown container */
  z-index: 5; /* A lower z-index to place it behind other elements */
}
</style>