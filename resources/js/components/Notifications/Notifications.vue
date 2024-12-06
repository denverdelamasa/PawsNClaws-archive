<template>
  <div class="dropdown dropdown-end">
    <button tabindex="0" class="btn btn-ghost btn-circle">
      <div class="indicator z-50">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-5 w-5"
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
        <span v-if="notifications.filter(n => !n.read_at).length > 0" class="badge badge-xs badge-primary indicator-item">
          {{ notifications.filter(n => !n.read_at).length }}
        </span>
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
          {{ notification.type }}
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
</style>
