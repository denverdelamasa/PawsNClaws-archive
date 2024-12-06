<template>
  <div>
    <!-- Modal Container -->
    <div v-if="isModalOpen" class="fixed inset-0 z-50  bg-opacity-50 flex justify-center items-center">
      <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <div class="flex justify-between items-center">
          <h3 class="text-xl font-semibold">{{ modalTitle }}</h3>
          <button @click="closeModal" class="text-gray-600 hover:text-gray-800">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
              <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 6.793l2.646-2.647a.5.5 0 0 1 .708.708L8.707 7.5l2.647 2.646a.5.5 0 0 1-.708.708L8 8.207l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 7.5 4.646 4.854a.5.5 0 0 1 0-.708z"/>
            </svg>
          </button>
        </div>
        <!-- Modal Content -->
        <div v-if="modalType === 'post'">
          <textarea v-model="content" placeholder="Write your post here..." class="w-full p-3 border border-gray-300 rounded-lg mt-4"></textarea>
        </div>
        <div v-if="modalType === 'announcement'">
          <input v-model="announcement" type="text" placeholder="Enter announcement..." class="w-full p-3 border border-gray-300 rounded-lg mt-4"/>
        </div>
        <div v-if="modalType === 'event'">
          <input v-model="eventTitle" type="text" placeholder="Event title..." class="w-full p-3 border border-gray-300 rounded-lg mt-4"/>
          <input v-model="eventDate" type="date" class="w-full p-3 border border-gray-300 rounded-lg mt-2"/>
        </div>
        <div class="mt-4 flex justify-end">
          <button @click="saveContent" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isModalOpen: false,
      modalType: '', // post, announcement, event
      modalTitle: '',
      content: '',
      announcement: '',
      eventTitle: '',
      eventDate: '',
    };
  },
  methods: {
    openModal(type) {
      this.modalType = type;
      this.modalTitle = this.getModalTitle(type);
      this.isModalOpen = true;
    },
    closeModal() {
      this.isModalOpen = false;
      // Reset form values when modal is closed
      this.resetForm();
    },
    getModalTitle(type) {
      switch (type) {
        case 'post': return 'Create Post';
        case 'announcement': return 'Create Announcement';
        case 'event': return 'Create Event';
        default: return '';
      }
    },
    saveContent() {
      // Save content logic, you can send this data to your backend
      console.log('Content Saved:', {
        content: this.content,
        announcement: this.announcement,
        eventTitle: this.eventTitle,
        eventDate: this.eventDate,
      });
      this.closeModal(); // Close modal after saving
    },
    resetForm() {
      this.content = '';
      this.announcement = '';
      this.eventTitle = '';
      this.eventDate = '';
    },
  },
};
</script>

<style scoped>
/* Add custom styles if needed */
</style>
