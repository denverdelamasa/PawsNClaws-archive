<template>
  <div class="flex flex-col h-screen">
    <div class="drawer lg:drawer-open">
      <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
      <div class="drawer-content flex flex-col items-center justify-start">
        <div class="w-full max-w-full h-full bg-base-100 rounded-xl shadow-xl flex flex-col">
          <div v-if="error" class="alert-error mb-4">{{ error }}</div>
          <div v-if="selectedConversation" class="sticky top-0 z-20 bg-base-100 border-b border-base-300 w-full px-2 py-2 flex items-center justify-between">
            <div class="flex items-center gap-3">
              <div class="avatar">
                <div class="w-10 rounded-full">
                  <img
                    :src="selectedConversation.other_user.profile_picture ? `storage/${selectedConversation.other_user.profile_picture}` : fallbackImage"
                    :alt="`${selectedConversation.other_user.username} Avatar`"
                  />
                </div>
              </div>
              <div>
                <h2 class="font-bold text-lg">{{ selectedConversation.other_user.name }}</h2>
                <p class="text-sm text-base-content/50">{{ selectedConversation.other_user.is_online ? 'Online' : 'Offline' }}</p>
              </div>
            </div>
            <button class="btn btn-sm btn-outline btn-primary" @click="visitProfile(selectedConversation.other_user.user_id)">
              Visit Profile
            </button>
          </div>
          <div v-else class="flex items-center justify-center h-full">
            <p class="text-base-content/50">Select a conversation to start chatting</p>
          </div>
          <Conversation
            v-if="selectedConversation"
            :messages="selectedConversation.messages"
            :current-user-id="currentUserId"
            :fallback-image="fallbackImage"
          />
          <div v-if="selectedConversation" class="flex items-center border-t border-base-300 pt-3 w-full sticky bottom-0 bg-base-100 z-10 px-2 py-2">
            <input
              v-model="newMessage"
              type="text"
              placeholder="Type your message..."
              class="input input-bordered w-full"
              @keyup.enter="sendMessage"
            />
            <button class="btn btn-primary" :disabled="isSendButtonDisabled" @click="sendMessage">
              Send
            </button>
          </div>
        </div>
      </div>
      <div class="drawer-side">
        <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
        <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4 gap-y-2">
          <strong class="text-3xl">CHATS</strong>
          <input
            type="text"
            placeholder="Search People..."
            class="input input-bordered border-base-300 input-accent max-w-xxs h-[40px] bg-base-100 hidden lg:block"
            v-model="searchQuery"
          />
          <div v-if="filteredConversations.length === 0 && !loading" class="text-base-content/50 mt-4">
            No ongoing adoption conversations found.
          </div>
          <UserList
            :conversations="filteredConversations"
            :fallback-image="fallbackImage"
            @select-conversation="selectConversation"
          />
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import UserList from './partials/UserList.vue';
import Conversation from './partials/Conversation.vue';

export default {
  components: {
    UserList,
    Conversation,
  },
  data() {
    return {
      conversations: [],
      selectedConversation: null,
      newMessage: '',
      searchQuery: '',
      loading: false,
      error: null,
      fallbackImage: 'https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.webp',
      currentUserId: parseInt(localStorage.getItem('user_id')) || null,
    };
  },
  computed: {
    filteredConversations() {
      if (!this.searchQuery) return this.conversations;
      const query = this.searchQuery.toLowerCase();
      return this.conversations.filter(conversation => {
        const other = conversation.other_user || {};
        return (other.username?.toLowerCase()?.includes(query) || other.name?.toLowerCase()?.includes(query));
      });
    },
    isSendButtonDisabled() {
        const disabled = this.loading || !this.newMessage.trim();
        console.log('Send button disabled:', disabled, { loading: this.loading, newMessage: this.newMessage });
        return disabled;
    },
  },
  async created() {
    await this.fetchConversations();
  },
  methods: {
    async fetchConversations() {
      this.loading = true;
      this.error = null;
      try {
        const response = await axios.get('/api/conversations', {
          headers: { 'Authorization': `Bearer ${localStorage.getItem('token')}` },
        });
        this.conversations = response.data.data || [];
        if (this.$route.params.id) {
          this.selectConversationById(parseInt(this.$route.params.id));
        }
      } catch (err) {
        this.error = err.response?.data?.message || 'Failed to fetch conversations';
      } finally {
        this.loading = false;
      }
    },
    selectConversation(conversation) {
      this.selectedConversation = conversation;
      this.$router.push(`/messages/${conversation.conversation_id}`);
    },
    selectConversationById(conversationId) {
      const id = parseInt(conversationId);
      if (isNaN(id)) {
        this.error = 'Invalid conversation ID';
        return;
      }
      const conversation = this.conversations.find(c => c.conversation_id === id);
      if (conversation) {
        this.selectedConversation = conversation;
      } else {
        this.error = 'Conversation not found';
      }
    },
    async sendMessage() {
        if (!this.newMessage.trim() || !this.selectedConversation) return;
        this.loading = true;
        this.error = null;
        try {
            const response = await axios.post(
            `/api/conversations/${this.selectedConversation.conversation_id}/messages`,
            { content: this.newMessage },
            { headers: { Authorization: `Bearer ${localStorage.getItem('token')}` } }
            );
            this.selectedConversation.messages.push(response.data.new_message);
            this.newMessage = '';
            // Optionally refresh conversations to update metadata
            await this.fetchConversations();
        } catch (err) {
            this.error = err.response?.data?.message || 'Failed to send message';
        } finally {
            this.loading = false;
        }
    },
    visitProfile(userId) {
      window.location.href = `/browse/view?user_id=${userId}`;
    },
  },
};
</script>

<style scoped>
.alert-error {
  @apply bg-red-100 text-red-700 p-4 rounded;
}
</style>