<template>
  <div v-if="post" class="p-4">
    <h1>{{ post.title }}</h1>
    <p>{{ post.content }}</p>
    <!-- Add more post details, images, comments, etc. -->
  </div>
  <div v-else>
    <p>Loading post...</p>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'PostDetail',
  props: ['id'],
  data() {
    return {
      post: null,
    };
  },
  async mounted() {
    try {
      const response = await axios.get(`/api/posts/${this.id}`);
      this.post = response.data.post;
    } catch (error) {
      console.error('Error fetching post:', error);
    }
  },
};
</script>