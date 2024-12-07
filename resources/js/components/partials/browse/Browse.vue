<template>
    <div>
      <button @click="changeContent('content1')" class="btn btn-primary">Show Content 1</button>
      <button @click="changeContent('content2')" class="btn btn-primary">Show Content 2</button>
  
      <div class="content">
        <p v-if="currentContent === 'content1'">This is Content 1</p>
        <p v-if="currentContent === 'content2'">This is Content 2</p>
      </div>
    </div>
</template>
  
<script>  
  export default {
    data() {
      return {
        currentContent: 'content1', // Default content
      };
    },
    methods: {
      changeContent(content) {
        this.currentContent = content; // Change content when button is clicked
      },
    },
  };
</script>
  