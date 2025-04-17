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
          <div class="flex-shrink-0 m-auto space-y-4 md:space-y-6 sm:p-8 w-[80vw] md:w-1/2 bg-base-100 shadow-lg transition-all">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-content md:text-2xl">
              Create an account
            </h1>
            <form @submit.prevent="handleSubmit" class="space-y-4 md:space-y-6">
              <div class="w-full">
                <label for="email" class="block mb-2 text-sm text-secondary font-medium">
                  Your Email
                </label>
                <div class="flex items-center gap-2">
                  <input
                    type="email"
                    v-model="form.email"
                    @input="checkAvailability('email')"
                    id="email"
                    class="input input-bordered w-full"
                    placeholder="name@company.com"
                    required
                  />
                  <button
                    type="button"
                    class="btn btn-outline btn-sm"
                    @click="sendOtp"
                    :disabled="otpStatus === 'verified' || !isValidEmail || !form.email"
                  >
                    {{ otpStatus === 'verified' ? 'Verified' : 'Verify' }}
                  </button>
                  <!-- Add validation message -->
                  <span 
                    v-if="form.email && !isValidEmail"
                    class="text-error text-sm"
                  >
                    Please enter a valid Gmail address
                  </span>
                </div>
              </div>
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
                <div class="relative">
                  <input
                    :type="showPassword ? 'text' : 'password'"
                    v-model="form.password"
                    @input="checkAvailability('password')"
                    id="password"
                    placeholder="••••••••"
                    class="input input-bordered w-full"
                    required
                  />
                  <span
                    @click="toggleShowPassword"
                    class="absolute inset-y-0 right-3 flex items-center cursor-pointer z-10"
                  >
                    <i
                      :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"
                      class="text-gray-500"
                      aria-hidden="true"
                    ></i>
                  </span>
                </div>
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
                <span
                  v-if="form.password_confirmation"
                  :class="{
                    'text-success': passwordsMatch,
                    'text-error': !passwordsMatch
                  }"
                  class="text-sm"
                >
                  {{ passwordsMatch ? "Passwords match!" : "Passwords do not match." }}
                </span>
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
              <p v-if="showVerifyMessage" class="text-error text-sm mt-2">
                Please verify your email before creating an account.
              </p>
              <p class="text-sm font-light text-secondary">
                Already have an account?
                <a
                  href="/login"
                  class="font-medium text-primary-600 hover:underline dark:text-primary-500"
                  >Login here</a
                >
              </p>
            </form>
            <div v-if="showOtpModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
              <div class="bg-base-200 p-6 rounded-lg shadow-lg w-[90%] max-w-md">
                <h2 class="text-lg font-bold mb-4">Enter OTP</h2>
                <p v-if="otpSentMessage" class="text-success text-sm mb-2">
                  {{ otpSentMessage }}
                </p>
                <input
                  v-model="enteredOtp"
                  type="text"
                  placeholder="Enter the 6-digit code"
                  class="input input-bordered w-full mb-4"
                  maxlength="6"
                />

                <div class="flex justify-end gap-2">
                  <button class="btn btn-outline" @click="closeOtpModal">Cancel</button>
                  <button class="btn btn-primary" @click="verifyOtp">
                    <span v-if="isSendingOtp" class="loading loading-spinner"></span>
                    <span v-else>Verify</span>
                  </button>
                </div>
                <p v-if="otpError" class="text-red-500 mt-2 text-sm">{{ otpError }}</p>

                <div class="flex justify-between items-center mt-4">
                  <p class="text-sm text-secondary">Didn't receive the code?</p>
                  <button
                    class="btn btn-link btn-sm text-primary p-0"
                    @click="resendOtp"
                    :disabled="resendCountdown > 0 || isResendingOtp"
                  >
                    <span v-if="isResendingOtp" class="loading loading-spinner loading-sm"></span>
                    <span v-else>
                      Resend OTP <span v-if="resendCountdown > 0">({{ resendCountdown }}s)</span>
                    </span>
                  </button>
                </div>
              </div>
            </div>

            <!-- ✅ Email Verified Success Modal -->
            <div
              v-if="showSuccessModal"
              class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            >
              <div class="bg-base-100 p-6 rounded-lg shadow-lg w-[90%] max-w-sm text-center">
                <h2 class="text-xl font-bold text-success mb-2">🎉 Verified!</h2>
                <p class="text-sm text-secondary">
                  {{ verificationMessage }}
                </p>
                <button class="btn btn-primary mt-4" @click="closeSuccessModal">OK</button>
              </div>
            </div>
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
        role: "",
        terms: false,
      },
      availability: {
        name: null,
        username: null,
        password: null,
      },
      showPassword: false,
      showOtpModal: false,
      enteredOtp: "",
      otpStatus: "", // '', 'pending', 'verified'
      otpError: "",
      otpSentMessage: "",
      isSendingOtp: false,
      showVerifyMessage: false,
      resendCountdown: 0,
      resendTimer: null,
      isResendingOtp: false,
      showSuccessModal: false,
      verificationMessage: "",
    };
  },
  computed: {
    // Computed property to check if passwords match
    passwordsMatch() {
      return this.form.password === this.form.password_confirmation;
    },
    isValidEmail() {
      return /^[^\s@]+@gmail\.com$/.test(this.form.email);
    }
  },
  methods: {
    toggleShowPassword() {
      this.showPassword = !this.showPassword;
    },
    async handleSubmit() {
      if (this.otpStatus !== 'verified') {
        this.showVerifyMessage = true;
        return;
      }

      this.showVerifyMessage = false;

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
    async sendOtp() {
      if (!this.isValidEmail) {
        this.otpError = "Please enter a valid Gmail address";
        return;
      }
      this.otpError = "";
      this.otpSentMessage = "";
      this.otpStatus = "pending";
      this.isSendingOtp = true;
      this.showOtpModal = true;

      try {
        await axios.post("/api/send-otp", {
          email: this.form.email,
        });

        this.otpSentMessage = "An OTP has been sent to your email successfully.";
        this.startResendCountdown();
      } catch (err) {
        this.otpError = "Failed to send OTP. Try again.";
      } finally {
        this.isSendingOtp = false;
      }
    },
    closeOtpModal() {
      this.showOtpModal = false;
      this.enteredOtp = "";
      this.otpError = "";
      if (this.otpStatus !== 'verified') {
        this.otpStatus = "";
      }
    },
    async verifyOtp() {
      try {
        const response = await axios.post("/api/verify-otp", {
          email: this.form.email,
          otp: this.enteredOtp,
        });

        if (response.data.verified) {
          this.otpStatus = "verified";
          this.otpError = "";
          this.showOtpModal = false;

          this.verificationMessage = "Your email has been successfully verified! 🎉";
          this.showSuccessModal = true; // ✅ Show success modal
        } else {
          this.otpError = "Invalid OTP. Please try again.";
        }
      } catch (err) {
        this.otpError = "Verification failed. Please try again.";
      }
    },
    startResendCountdown(seconds = 30) {
      this.resendCountdown = seconds;
      if (this.resendTimer) clearInterval(this.resendTimer);
      this.resendTimer = setInterval(() => {
        if (this.resendCountdown > 0) {
          this.resendCountdown--;
        } else {
          clearInterval(this.resendTimer);
        }
      }, 1000);
    },
    async resendOtp() {
      this.otpError = "";
      this.otpSentMessage = "";
      this.isResendingOtp = true;

      try {
        const response = await axios.post("/api/send-otp", {
          email: this.form.email,
        });

        this.otpSentMessage = "A new OTP has been sent to your email.";
        this.startResendCountdown();
      } catch (err) {
        this.otpError = "Failed to resend OTP. Please try again.";
      } finally {
        this.isResendingOtp = false;
      }
    },
    closeOtpModal() {
      this.showOtpModal = false;
      this.enteredOtp = "";
      this.otpError = "";
    },
    closeSuccessModal() {
      this.showSuccessModal = false;
    },
  },
  beforeDestroy() {
    if (this.resendTimer) clearInterval(this.resendTimer);
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
