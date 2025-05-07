<template>
  <li
    v-for="conversation in validConversations"
    :key="conversation.conversation_id"
    class="p-2 border-b-2 border-base-300 cursor-pointer hover:bg-base-300"
    @click="$emit('select-conversation', conversation)"
  >
    <a class="flex items-center gap-2">
      <figure class="m-auto w-8 h-8 rounded-full overflow-hidden">
        <img
          :src="conversation.other_user.profile_picture ? `/storage/${conversation.other_user.profile_picture}` : fallbackImage"
          :alt="`${conversation.other_user.username} Avatar`"
          class="w-full h-full object-cover"
          @error="handleImageError"
        />
      </figure>
      <div class="flex flex-col">
        <strong>{{ conversation.other_user.username || 'Unknown User' }}</strong>
        <p v-if="conversation.messages?.length > 0" class="text-sm truncate">
          {{ conversation.messages[conversation.messages.length - 1].content }}
        </p>
        <p v-else class="text-sm text-base-content/50">
          Related to: {{ conversation.application?.adopter_name || 'Unknown Application' }}
        </p>
      </div>
    </a>
  </li>
</template>

<script>
export default {
  props: {
    conversations: {
      type: Array,
      required: true,
    },
    fallbackImage: {
      type: String,
      required: true,
    },
  },
  emits: ['select-conversation'],
  computed: {
    currentUserId() {
      return parseInt(localStorage.getItem('user_id')) || null;
    },
    validConversations() {
      // Filter out conversations where other_user is the current user
      return this.conversations.filter(conversation => {
        return conversation.other_user && conversation.other_user.user_id !== this.currentUserId;
      });
    },
  },
  methods: {
    handleImageError(event) {
      event.target.src = this.fallbackImage;
    },
    selectConversation(conversation) {
      this.$emit('select-conversation', conversation);
    },
  },
};
</script>