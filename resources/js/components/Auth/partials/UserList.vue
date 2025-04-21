<template>
<li v-for="application in applications" :key="application.application_id" class="p-2 border-b-2 border-base-300">
        <a>
            <figure class="m-auto w-8 h-8 rounded-full overflow-hidden">
                <img
                    :src="`/storage/${application.sender.profile_picture}`"
                    alt="User Avatar"
                    class="w-full h-full object-cover" />
            </figure>
            <div class="flex flex-col">
                <strong>{{ application.sender.username }}</strong>
                <p>Hellow! ako po ay isang... </p>
            </div>
        </a>
    </li>
</template>
<script>
export default {
  name: 'OngoingApplications',
  data() {
    return {
      applications: [],
      loading: false,
      error: null,
    };
  },
  async created() {
    await this.fetchOngoingApplications();
  },
  methods: {
    async fetchOngoingApplications() {
      this.loading = true;
      try {
        const response = await fetch('/api/user/ongoing');
        if (!response.ok) {
          throw new Error('Failed to fetch adoption applications');
        }
        const data = await response.json();
        this.applications = data.data;
      } catch (err) {
        this.error = err.message;
      } finally {
        this.loading = false;
      }
    },
  },
};
</script>