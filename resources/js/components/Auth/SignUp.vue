<template>
  <div>
    <section class="bg-base-200 h-[100vh] hide-scrollbar m-auto">
      <div class="h-full">
        <div class="flex flex-row items-center justify-center min-h-screen">
          <!-- Centered image div -->
          <div class="group relative hidden md:block flex-shrink-0 m-auto">
            <!-- Hoverable Image Div -->
            <div
              class="bg-cover bg-center w-full md:w-[40vw] h-[90vh] 
              hover:scale-105 transition-all rounded-xl filter brightness-75"
              :style="{ backgroundImage: 'url(/images/pictures/pexels-lensloji.jpg)' }"
            ></div>

            <!-- Tooltip content appears on hover -->
            <div
              class="absolute bottom-2 left-2 bg-black text-white text-sm p-2 rounded opacity-0 group-hover:opacity-100 transition-opacity"
            >
              Photographer: Lensloji
            </div>
          </div>

          <!-- Centered form div -->
          <div
            class="flex-shrink-0 m-auto space-y-4 md:space-y-6 sm:p-8 w-[80vw] md:w-1/2 bg-base-100 shadow-lg transition-all"
          >
            <h1 class="text-xl font-bold leading-tight tracking-tight text-content md:text-2xl">
              Create an account
            </h1>
            <form @submit.prevent="handleSubmit" class="space-y-4 md:space-y-6">
              <div>
                <label
                  for="email"
                  class="block mb-2 text-sm text-secondary font-medium"
                  >Your email</label
                >
                <input
                  type="email"
                  v-model="form.email"
                  @input="checkAvailability('email')"
                  id="email"
                  class="input input-bordered w-full"
                  placeholder="name@company.com"
                  required
                />
                <span
                    v-if="availability.email"
                    :class="{
                    'text-success': availability.email.available,
                    'text-error': !availability.email.available
                    }"
                    class="text-sm"
                >
                    {{ availability.email.message }}
                </span>
              </div>
              <div>
                <label
                  for="name"
                  class="block mb-2 text-sm font-medium text-secondary"
                  >Name</label
                >
                <input
                  type="text"
                  v-model="form.name"
                  @input="checkAvailability('name')"
                  id="name"
                  placeholder="Your Name"
                  class="input input-bordered w-full"
                  required
                />
                <span
                    v-if="availability.name"
                    :class="{
                    'text-success': availability.name.available,
                    'text-error': !availability.name.available
                    }"
                    class="text-sm"
                >
                    {{ availability.name.message }}
                </span>
              </div>
              <div>
                <label
                  for="username"
                  class="block mb-2 text-sm font-medium text-secondary"
                  >Username</label
                >
                <input
                  type="text"
                  v-model="form.username"
                  @input="checkAvailability('username')"
                  id="username"
                  placeholder="_Username123"
                  class="input input-bordered w-full"
                  required
                />
                <span
                    v-if="availability.username"
                    :class="{
                    'text-success': availability.username.available,
                    'text-error': !availability.username.available
                    }"
                    class="text-sm"
                >
                    {{ availability.username.message }}
                </span>
              </div>
              <div>
                <label
                  for="password"
                  class="block mb-2 text-sm font-medium text-secondary"
                  >Password</label
                >
                <input
                  type="password"
                  v-model="form.password"
                  @input="checkAvailability('password')"
                  id="password"
                  placeholder="••••••••"
                  class="input input-bordered w-full"
                  required
                />
                <span
                    v-if="availability.password"
                    :class="{
                    'text-success': availability.password.valid,
                    'text-error': !availability.password.valid
                    }"
                    class="text-sm"
                >
                    {{ availability.password.message }}
                </span>
              </div>
              <div>
                <label
                  for="confirm-password"
                  class="block mb-2 text-sm font-medium text-secondary"
                  >Confirm password</label
                >
                <input
                  type="password"
                  v-model="form.password_confirmation"
                  id="confirm-password"
                  placeholder="••••••••"
                  class="input input-bordered w-full"
                  required
                />
              </div>
              <div class="flex items-start">
                <div class="flex items-center h-5">
                  <input
                    id="terms"
                    type="checkbox"
                    v-model="form.terms"
                    class="checkbox checkbox-base-100"
                    required
                  />
                </div>
                <div class="ml-3 text-sm">
                  <label for="terms" class="font-light text-secondary"
                    >I accept the
                    <a
                      class="font-medium text-primary-600 hover:underline dark:text-primary-500"
                      href="/pages/terms-and-conditions"
                      >Terms and Conditions</a
                    ></label
                  >
                </div>
              </div>
              <button type="submit" class="btn btn-primary w-full">
                Create an account
              </button>
              <p class="text-sm font-light text-secondary">
                Already have an account?
                <a
                  href="/form/login"
                  class="font-medium text-primary-600 hover:underline dark:text-primary-500"
                  >Login here</a
                >
              </p>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      form: {
        email: "",
        name: "",
        username: "",
        password: "",
        password_confirmation: "",
        terms: false,
      },
      availability: {
        name: null,
        username: null,
        password: null,
      },
    };
  },
  methods: {
    async handleSubmit() {
      try {
        const response = await axios.post("/signup", this.form);
        console.log(response.data); // Handle success
        if (response.status === 200 || response.status === 201) {
          // Redirect to the home page
          window.location.href = "/home";
        }
        alert("Account created successfully!");
      } catch (error) {
        console.error(error.response.data); // Handle error
        alert("Error creating account. Please try again.");
      }
    },
    async checkAvailability(field) {
      try {
        const response = await axios.post("/api/check-availability", {
          [field]: this.form[field],
        });
        this.availability[field] = response.data[field];
      } catch (error) {
        console.error("Error checking availability:", error.response?.data || error.message);
      }
    },
  },
};
</script>

<style scoped>
/* Hide the scrollbar but allow scrolling */
.hide-scrollbar::-webkit-scrollbar {
  display: none; /* Hides scrollbar in WebKit browsers */
}

.hide-scrollbar {
  -ms-overflow-style: none; /* Hides scrollbar in IE and Edge */
  scrollbar-width: none; /* Hides scrollbar in Firefox */
  overflow: auto; /* Ensure scrolling is enabled */
}
</style>
