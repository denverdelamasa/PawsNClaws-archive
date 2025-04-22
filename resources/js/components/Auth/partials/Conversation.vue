<template>
  <div class="flex-1 overflow-y-auto space-y-4 py-4 px-2 hide-scrollbar w-full">
    <!-- Display placeholder if no messages -->
    <div v-if="messagesToDisplay.length === 0" class="flex items-center justify-center h-full">
      <p class="text-base-content/50 text-lg">Start a conversation</p>
    </div>
    <!-- Messages list -->
    <div
      v-for="message in messagesToDisplay"
      :key="message.message_id"
      :class="['chat', message.sender_id === currentUserId ? 'chat-end' : 'chat-start']"
    >
      <div class="chat-image avatar">
        <div class="w-8 rounded-full">
          <img
            :src="message.sender.profile_picture ? `/storage/${message.sender.profile_picture}` : fallbackImage"
            :alt="`${message.sender.username} Avatar`"
            @error="handleImageError"
          />
        </div>
      </div>
      <div class="chat-header">
        {{ message.sender_id === currentUserId ? 'You' : message.sender.username }}
        <time class="text-xs opacity-50 ml-1">{{ formatTime(message.created_at) }}</time>
      </div>
      <div :class="['chat-bubble', message.sender_id === currentUserId ? 'chat-bubble-primary' : '']">
        {{ message.content }}
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: {
    messages: {
      type: Array,
      default: () => [],
    },
    currentUserId: {
      type: Number,
      required: true,
    },
    fallbackImage: {
      type: String,
      required: true,
    },
    conversationId: {
      type: Number,
      default: null,
    },
  },
  data() {
    return {
      internalMessages: [],
      loading: false,
      error: null,
    };
  },
  computed: {
    messagesToDisplay() {
      return this.internalMessages.length > 0 ? this.internalMessages : this.messages;
    },
  },
  async created() {
    if (this.conversationId) {
      await this.fetchMessages();
    }
  },
  methods: {
    formatTime(timestamp) {
      return new Date(timestamp).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    },
    handleImageError(event) {
      event.target.src = this.fallbackImage;
    },
    async fetchMessages() {
      if (!this.conversationId) return;

      this.loading = true;
      this.error = null;
      try {
        const response = await axios.get(`/api/conversations/${this.conversationId}/messages`, {
          headers: { Authorization: `Bearer ${localStorage.getItem('token')}` },
        });

        if (!response.data?.success || !Array.isArray(response.data.data)) {
          throw new Error('Invalid response structure from server');
        }

        this.internalMessages = response.data.data.map(message => ({
          message_id: message.message_id,
          sender_id: message.sender_id,
          content: message.content,
          created_at: message.created_at,
          sender: {
            username: message.sender?.username || 'Unknown User',
            profile_picture: message.sender?.profile_picture || null,
          },
        }));
      } catch (err) {
        this.error = err.response?.data?.message || 'Failed to fetch messages. Please try again.';
        console.error('Fetch messages error:', err);
      } finally {
        this.loading = false;
      }
    },
  },
  updated() {
    const container = this.$el.querySelector('.flex-1');
    container.scrollTop = container.scrollHeight;
  },
};
</script>

<style scoped>
.hide-scrollbar::-webkit-scrollbar {
  display: none;
}
.hide-scrollbar {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
</style>