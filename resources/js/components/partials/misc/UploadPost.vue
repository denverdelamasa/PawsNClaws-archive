<template>
  <div class="card bg-base-200 shadow-md w-full border border-base-300 p-4">
    <div class="flex items-start gap-4">
      <!-- Profile Picture -->
      <img :src="userProfile.profile_picture ? `/storage/${userProfile.profile_picture}` : '/storage/images/defaultpics/default-profile.png'"  alt="Profile" class="rounded-full object-cover w-12 h-12" />
      
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
        <div v-if="['Shelter', 'Vet Clinic', 'Admin'].includes(userProfile.role)" class="border-b border-b-base-100 my-2 py-2"></div>
        <div v-if="['Shelter', 'Vet Clinic', 'Admin'].includes(userProfile.role)" class="mt-2 flex gap-2 flex-wrap">
          <button @click="openModal('announcement')" class="btn btn-accent btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
            </svg>
            Announcement
          </button>
          <button @click="openModal('event')" class="btn btn-info btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
            </svg>
            Event
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Post Modal -->
  <dialog v-if="modalType" class="modal" :id="`${modalType}boxModal`">
    <div class="modal-box">
      <form v-if="modalType === 'announcement'" @submit.prevent="handleSubmitAnnouncement" class="flex flex-col gap-y-2">
        <!-- Close Button -->
        <button type="button" @click="closeModal" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
          ✕
        </button>

        <h3 v-if="modalType === 'announcement'" class="font-bold text-2xl">Create Announcement</h3>

        <div v-if="modalType === 'announcement' && validationMessage" class="text-error text-sm mb-2">
          {{ validationMessage }}
        </div>

        <div v-if="modalType === 'announcement'">
          <input type="text" class="textarea textarea-bordered w-full" v-model="modalData.title"placeholder="Write a title..." required></input>
        </div>

        <!-- Description (Visible for announcement) -->
        <div v-if="modalType === 'announcement'">
          <textarea 
            class="textarea textarea-bordered w-full" 
            v-model="modalData.description" 
            placeholder="Write a description" 
            required
          ></textarea>
        </div>

        <!-- Announcement Thumbnail -->
        <div v-if="modalType === 'announcement'">
          <button id="btnImage" type="button" class="btn btn-primary btn-sm mb-4" @click="triggerFileInput">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
              <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
              <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1z"/>
            </svg> 
            Add Thumbnail
          </button>

          <!-- Hidden File Input for Image -->
          <input type="file" id="thumbnail" class="hidden" ref="imageInput" @change="handleImageChange" />

          <!-- Image Preview -->
          <div v-if="modalData.thumbnail" class="my-4">
            <img :src="modalData.image_previews" alt="Image Preview" class="w-full max-h-64 object-cover rounded-lg" />
          </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary mt-4">Submit</button>
      </form>
      <form v-if="modalType === 'post'" @submit.prevent="handleSubmitPost">
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

        <!-- Validation Message for Post -->
        <div v-if="modalType === 'post' && validationMessage" class="text-error text-sm mb-2">
          {{ validationMessage }}
        </div>

        <!-- Caption (Visible for 'post', 'announcement', and 'event' types) -->
        <div v-if="modalType === 'post'">
          <textarea 
            class="textarea textarea-bordered w-full" 
            v-model="modalData.caption" 
            placeholder="Write a caption..." 
            required
          ></textarea>
        </div>

        <!-- Image Upload Button (Visible for 'post' and 'event' types) -->
        <div v-if="modalType === 'post'">
          <button id="btnImage" type="button" class="btn btn-primary btn-sm mb-4" @click="triggerFileInput">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
              <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
              <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1z"/>
            </svg> 
            Add Image
          </button>

          <!-- Hidden File Input for Image -->
          <input type="file" id="image_path" class="hidden" ref="imageInput" @change="handleImageChange" multiple/>

          <!-- Image Preview -->
          <div v-if="modalData.image_previews.length > 0" class="my-4">
            <div class="grid grid-cols-3 gap-2">
              <div v-for="(preview, index) in modalData.image_previews" :key="index" class="relative">
                <img :src="preview" alt="Image Preview" class="w-full h-24 object-cover rounded-lg" />
                <button 
                  type="button" 
                  @click="removeImage(index)" 
                  class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center"
                >
                  ✕
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Checkbox for Adoption (Visible for 'post' type only) -->
        <div v-if="modalType === 'post'">
          <label class="flex items-center gap-2">
            <input 
              type="checkbox" 
              class="checkbox" 
              v-model="modalData.is_adoptable"
            />
            <span>This post is for adoption</span>
          </label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary mt-4">Submit</button>
      </form>
      <!-- Event Modal -->
      <form v-if="modalType === 'event'" @submit.prevent="handleSubmitEvent" class="flex flex-col gap-y-2">
        <button type="button" @click="closeModal" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
          ✕
        </button>

        <h3 v-if="modalType === 'event'" class="font-bold text-2xl">Create Event</h3>

        <div v-if="modalType === 'event' && validationMessage" class="text-error text-sm mb-2">
          {{ validationMessage }}
        </div>

        <div v-if="modalType === 'event'">
          <input type="text" class="textarea textarea-bordered w-full" v-model="modalData.event_location"placeholder="Location" required></input>
        </div>
        
        <div v-if="modalType === 'event'">
          <input type="text" class="textarea textarea-bordered w-full" v-model="modalData.event_title"placeholder="Write a title..." required></input>
        </div>

        <!-- Description (Visible for announcement) -->
        <div v-if="modalType === 'event'">
          <textarea class="textarea textarea-bordered w-full" v-model="modalData.event_description" placeholder="Write a description" required></textarea>
        </div>
        
        <!-- Event Date -->
        <div v-if="modalType === 'event'">
          <label class="label text-white">Select Event Date</label>
          <input type="date" class="input input-bordered w-full" v-model="modalData.event_date" required/>
        </div>

        <!-- Announcement Thumbnail -->
        <div v-if="modalType === 'event'">
          <button id="btnImage" type="button" class="btn btn-primary btn-sm mb-4" @click="triggerFileInput">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
              <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
              <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1z"/>
            </svg> 
            Add Thumbnail
          </button>

          <!-- Hidden File Input for Image -->
          <input type="file" id="event_thumbnail" class="hidden" ref="imageInput" @change="handleImageChange" multiple/>

          <!-- Image Preview -->
          <div v-if="modalData.image_previews.length > 0" class="my-4">
            <div class="grid grid-cols-3 gap-2">
              <div v-for="(preview, index) in modalData.image_previews" :key="index" class="relative">
                <img :src="preview" alt="Image Preview" class="w-full h-24 object-cover rounded-lg" />
                <button 
                  type="button" 
                  @click="removeImage(index)" 
                  class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center"
                >
                  ✕
                </button>
              </div>
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
import Swal from 'sweetalert2';
import axios from "axios";

export default {
  props: {
    fetchPostsProp: {
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
        image_path: [],
        image_previews: [],
        is_adoptable: false,
        thumbnail: null,
        title: "",
        description: "",
        event_title: "",
        event_description: "",
        event_date: "",
        event_thumbnail: null,
      },
      userProfile: {
        profile_picture: "",
        role: "",
      },
      maxPostImages: 5,
      validationMessage: "",
    };
  },
  methods: {
    openModal(type) {
      this.modalType = type;
      this.validationMessage = "";
      this.$nextTick(() => {
        document.getElementById(`${type}boxModal`).showModal();
      });
    },
    closeModal() {
      this.modalType = null;
      this.validationMessage = "";
      document.querySelector("dialog").close();
    },
    handleImageChange(event) {
      const files = event.target.files;
      if (files) {
        if (this.modalType === "post") {
          // Check if the total number of images exceeds the limit
          if (this.modalData.image_path.length + files.length > this.maxPostImages) {
            this.validationMessage = `You can only upload up to ${this.maxPostImages} images for a post.`;
            return;
          }

          // Add new images to the list
          for (let i = 0; i < files.length; i++) {
            const file = files[i];
            this.modalData.image_path.push(file);
            this.modalData.image_previews.push(URL.createObjectURL(file));
          }
        } else if (this.modalType === "announcement") {
          // For announcements, only allow one image
          if (files.length > 1) {
            this.validationMessage = "You can only upload one image for an announcement.";
            return;
          }

          // Replace the existing image with the new one
          this.modalData.thumbnail = files[0];
          this.modalData.image_previews = [URL.createObjectURL(files[0])];
        } else if (this.modalType === "event") {
          if(files.length > 5) {
            this.validationMessage = "You can upload five images for an event";
            return;
          }

          this.modalData.event_thumbnail = Array.from(files);
          this.modalData.image_previews = [];

          for (let i = 0; i < files.length; i++) {
            this.modalData.image_previews.push(URL.createObjectURL(files[i]));
          }
        }
      }
    },
    async handleSubmitPost() {
      if (this.modalData.image_path.length > this.maxPostImages) {
        this.validationMessage = `You can only upload up to ${this.maxPostImages} images for a post.`;
        return;
      }

      const formData = new FormData();
      formData.append("caption", this.modalData.caption);

      this.modalData.image_path.forEach((image, index) => {
        formData.append(`images[${index}]`, image);
      });

      formData.append("is_adoptable", this.modalData.is_adoptable ? "1" : "0");

      try {
        const response = await axios.post("/api/posts/upload", formData);
        this.closeModal();
        this.resetForm();

        // Fetch the latest posts after creating a new post
        this.fetchPosts(true); // Reset and fetch latest posts
      } catch (error) {
        console.error("Error creating post:", error);
        this.validationMessage = "Something went wrong while uploading your post.";
      }
    },
    handleSubmitAnnouncement() {
      const formData = new FormData();
      formData.append("title", this.modalData.title);
      formData.append("description", this.modalData.description);

      if (this.modalData.thumbnail) {
        formData.append("thumbnail", this.modalData.thumbnail);
      }

      axios
        .post("/api/announcement/upload", formData)
        .then((response) => {
          console.log("Post created:", response.data);
          this.closeModal();
          this.resetForm();
          this.fetchPosts();

          Swal.fire({
            position: "bottom-end",
            icon: "success",
            title: "Your announcement has been uploaded successfully!",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: "#1e293b",
            color: "#ffffff",
            toast: true,
          });
        })
        .catch((error) => {
          console.error("Error creating post:", error);

          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong while uploading your post!",
            background: "#1e293b",
            color: "#ffffff",
          });
        });
    },
    handleSubmitEvent() {
      const formData = new FormData();
      formData.append("event_title", this.modalData.event_title);
      formData.append("event_description", this.modalData.event_description);
      formData.append("event_date", this.modalData.event_date);
      formData.append("event_location", this.modalData.event_location);

      if (this.modalData.event_thumbnail && this.modalData.event_thumbnail.length > 0) {
        this.modalData.event_thumbnail.forEach((file, index) => {
          formData.append(`event_thumbnail[${index}]`, file);
        });
      }

      axios
        .post("/api/events/upload", formData)
        .then((response) => {
          console.log("Post created:", response.data);
          this.closeModal();
          this.resetForm();

          Swal.fire({
            position: "bottom-end",
            icon: "success",
            title: "Your announcement has been uploaded successfully!",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: "#1e293b",
            color: "#ffffff",
            toast: true,
          });
        })
        .catch((error) => {
          console.error("Error creating post:", error);

          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong while uploading your post!",
            background: "#1e293b",
            color: "#ffffff",
          });
        });
    },
    removeImage(index) {
      this.modalData.image_path.splice(index, 1);
      this.modalData.image_previews.splice(index, 1);
    },
    fetchPosts() {
      axios.get("/api/posts/list")
        .then((response) => {
          this.posts = response.data; // Update the posts list
        })
        .catch((error) => {
          console.error("Error fetching posts:", error);
        });
    },
    triggerFileInput() {
      this.$refs.imageInput.accept = 'image/*';
      this.$refs.imageInput.multiple = ['post', 'event', 'announcement'].includes(this.modalType); // Allow multiple files for posts, events, and announcements
      this.$refs.imageInput.click();
    },
    resetForm() {
      this.modalData.caption = "";
      this.modalData.image_path = [];
      this.modalData.image_previews = [];
      this.modalData.is_adoptable = false;
      this.modalData.thumbnail = null;
      this.modalData.title = "";
      this.modalData.description = "";
      this.modalData.event_title = "",
      this.modalData.event_description = "",
      this.modalData.event_thumbnail = null,
      this.modalData.event_location = ""
    },
    fetchUserProfile() {
      axios
        .get("/api/user-profile")
        .then((response) => {
          this.userProfile = response.data;
        })
        .catch((error) => {
          console.error("Error fetching user profile:", error);
        });
    },
  },
  mounted() {
    this.fetchUserProfile(); // Fetch user profile when the component is mounted
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
  .text-error {
    color: #ff4444; /* Red color for error messages */
  }
</style>