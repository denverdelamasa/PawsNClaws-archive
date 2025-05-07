<template>
  <span v-if="pendingCount > 0" class="badge badge-primary badge-sm absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2">
    {{ pendingCount }}
  </span>
</template>

<script>
import axios from 'axios';

export default {
  name: 'AdoptionPendingCount',
  data() {
    return {
      pendingCount: 0,
    };
  },
  created() {
    this.fetchPendingCount();
    // Poll every 30 seconds for updates
    this.interval = setInterval(this.fetchPendingCount, 10000);
  },
  beforeDestroy() {
    clearInterval(this.interval);
  },
  methods: {
    async fetchPendingCount() {
      try {
        const response = await axios.get('/api/user/adoption/pending-count', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`,
          },
        });
        this.pendingCount = response.data.pending_count;
      } catch (error) {
        console.error('Error fetching pending applications count:', error);
      }
    },
  },
};
</script>

<style scoped>
.badge-primary {
  background-color: #3b82f6;
  color: white;
  font-size: 0.75rem;
  padding: 0.25rem 0.5rem;
  border-radius: 9999px;
  min-width: 1.25rem;
  height: 1.25rem;
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>