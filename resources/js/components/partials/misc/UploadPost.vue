<template>
  <div class="card bg-base-200 shadow-md w-full max-w-full border border-base-300 p-4">
    <div class="flex items-start gap-4" id="observedDiv">
      <!-- Profile Picture -->
      <img src="https://picsum.photos/200" alt="Profile" class="w-12 h-12 rounded-full" />
      
      <!-- Input and Buttons -->
      <div class="flex-grow">
        <div
          @click="openModal('post')"
          class="flex items-center justify-start bg-base-300 p-3 rounded-full hover:bg-base-100 duration-200 transition-all"
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil mr-2" viewBox="0 0 16 16">
            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
          </svg>
          Share your thoughts!
        </div>
        <div class="border-b border-b-base-100 my-2 py-2"></div>
        <div class="mt-2 flex gap-2 flex-wrap">
          <button @click="openModal('post')" class="btn btn-primary btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
            </svg>
            Post
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <dialog v-if="modalType" class="modal" :id="`${modalType}boxModal`">
    <div class="modal-box">
      <form @submit.prevent="handleSubmit">
        <!-- Close Button -->
        <button 
          type="button" 
          @click="closeModal" 
          class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
        >
          ✕
        </button>

        <!-- Modal Title Based on Type -->
        <h3 v-if="modalType === 'post'" class="font-bold text-lg">Create Post</h3>

        <!-- Caption (Visible only for 'post' type) -->
        <div v-if="modalType === 'post'">
          <textarea 
            class="textarea textarea-bordered w-full" 
            v-model="modalData.caption" 
            placeholder="Write a caption..." 
            required
          ></textarea>

          <!-- Image Upload Button -->
          <div v-if="modalType === 'post'">
            <button 
              id="btnImage" 
              type="button" 
              class="btn btn-primary btn-sm mb-4" 
              @click="triggerFileInput"
            >
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1z"/>
              </svg>
              Add Image
            </button>

            <!-- Hidden File Input for Image -->
            <input 
              type="file" 
              id="image_path" 
              class="hidden" 
              ref="imageInput" 
              @change="handleImageChange"
            />

            <!-- Image Preview -->
            <div v-if="modalData.image_preview" class="my-4">
                <img :src="modalData.image_preview" alt="Image Preview" class="w-full max-h-64 object-cover rounded-lg" />
            </div>
          </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary mt-4">Submit</button>
      </form>
    </div>
  </dialog>
</template>

<script>
export default {
  props: {
    fetchPosts: {
      type: Function,
      required: true
    }
  },
  data() {
    return {
      posts: [], // To store fetched posts
      modalType: null,
      modalData: {
        caption: "",
        image_path: null,
        image_preview: null,
      },
    };
  },
  methods: {
    openModal(type) {
      this.modalType = type;
      this.$nextTick(() => {
        document.getElementById(`${type}boxModal`).showModal();
      });
    },
    closeModal() {
      this.modalType = null;
      document.querySelector("dialog").close();
    },
    handleImageChange(event) {
      const file = event.target.files[0];
      if (file) {
        this.modalData.image_path = file;
        this.modalData.image_preview = URL.createObjectURL(file);
      }
    },
    handleSubmit() {
      const formData = new FormData();
      formData.append("caption", this.modalData.caption);

      if (this.modalData.image_path) {
        formData.append("image_path", this.modalData.image_path);
      }

      axios
        .post("/api/posts", formData)
        .then((response) => {
          console.log("Post created:", response.data);
          this.closeModal();
          this.resetForm();
          this.fetchPosts(); // Fetch posts after successfully creating a post
        })
        .catch((error) => {
          console.error("Error creating post:", error);
        });
    },
    fetchPosts() {
      axios
        .get("/api/posts")
        .then((response) => {
          this.posts = response.data; // Update the posts list
        })
        .catch((error) => {
          console.error("Error fetching posts:", error);
        });
    },
    triggerFileInput() {
      this.$refs.imageInput.click();
    },
    resetForm() {
      this.modalData.caption = "";
      this.modalData.image_path = null;
      this.modalData.image_preview = null;
    },
  },
};
</script>

<style scoped>
.modal-box {
  max-width: 500px;
  padding: 20px;
}

textarea {
  min-height: 150px;
}

input[type="file"] {
  display: none;
}
</style>
