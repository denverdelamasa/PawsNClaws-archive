<template>
  <div class="flex-1 overflow-y-auto space-y-4 py-4 px-2 hide-scrollbar w-full" @scroll="handleScroll" ref="chatContainer">
    <!-- Display placeholder if no messages -->
    <div v-if="messagesToDisplay.length === 0" class="flex items-center justify-center h-full">
      <p class="text-base-content/50 text-lg">Start a conversation</p>
    </div>
    <div v-if="loading && page > 1" class="flex items-center justify-center py-2">
        <span class="text-base-content/50">Loading more messages...</span>
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
      page: 1,
      lastPage: 1,
      perPage: 20,
      isFetchingMore: false,
    };
  },
  computed: {
    messagesToDisplay() {
      return this.internalMessages.length > 0 ? this.internalMessages : this.messages;
    },
  },
  watch: {
    conversationId: {
      handler(newId) {
        if (newId) {
          this.page = 1;
          this.internalMessages = [];
          this.fetchMessages();
        }
      },
      immediate: true,
    },
    messages(newMessages) {
      if (newMessages.length > 0) {
        const lastNewMessage = newMessages[newMessages.length - 1];
        const lastInternalMessage = this.internalMessages[this.internalMessages.length - 1];
        if (
          !lastInternalMessage ||
          lastNewMessage.message_id !== lastInternalMessage.message_id
        ) {
          this.internalMessages.push(lastNewMessage);
          this.scrollToBottom();
        }
      }
    },
  },
  methods: {
    formatTime(timestamp) {
      return new Date(timestamp).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    },
    handleImageError(event) {
      event.target.src = this.fallbackImage;
    },
    scrollToBottom() {
      this.$nextTick(() => {
        const container = this.$refs.chatContainer;
        if (container) {
          container.scrollTop = container.scrollHeight;
        }
      });
    },
    async fetchMessages(append = false) {
      if (!this.conversationId || this.loading || (append && this.page >= this.lastPage)) {
        return;
      }

      this.loading = true;
      this.error = null;

      try {
        const response = await axios.get(
          `/api/conversations/${this.conversationId}/messages`,
          {
            headers: { Authorization: `Bearer ${localStorage.getItem('token')}` },
            params: { page: this.page, per_page: this.perPage },
          }
        );

        if (!response.data?.success || !Array.isArray(response.data.data)) {
          throw new Error('Invalid response structure from server');
        }

        const messages = response.data.data.map(message => ({
          message_id: message.message_id,
          sender_id: message.sender_id,
          content: message.content,
          created_at: message.created_at,
          sender: {
            username: message.sender?.username || 'Unknown User',
            profile_picture: message.sender?.profile_picture || null,
          },
        }));

        messages.reverse(); // Ensure oldest messages are at the top

        if (append) {
          this.internalMessages = [...messages, ...this.internalMessages];
        } else {
          this.internalMessages = messages;
          this.scrollToBottom();
        }

        this.page = response.data.meta.current_page;
        this.lastPage = response.data.meta.last_page;
        this.perPage = response.data.meta.per_page;
      } catch (err) {
        this.error = err.response?.data?.message || 'Failed to fetch messages. Please try again.';
        console.error('Fetch messages error:', err);
      } finally {
        this.loading = false;
      }
    },
    handleScroll() {
      if (this.loading || this.page >= this.lastPage) return;

      const container = this.$refs.chatContainer;
      if (container.scrollTop < 100 && !this.isFetchingMore) {
        this.isFetchingMore = true;
        this.page += 1;
        this.fetchMessages(true).finally(() => {
          this.isFetchingMore = false;
        });
      }
    },
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