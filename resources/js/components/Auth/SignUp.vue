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
          <div class="flex-shrink-0 m-auto space-y-4 md:space-y-6 sm:p-8 p-4 w-[80vw] md:w-1/2 bg-base-100 shadow-lg transition-all">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-content md:text-2xl">
              Create an account
            </h1>
            <form @submit.prevent="handleSubmit" class="space-y-4 md:space-y-6">
              <div class="w-full">
                <label for="email" class="block mb-2 text-sm font-medium">
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
                </div>
              </div>
              <!-- Validation: Invalid email format -->
              <span 
                v-if="form.email && !isValidEmail"
                class="text-error text-sm"
              >
                Please enter a valid Gmail address
              </span>

              <!-- Validation: Email availability (only if valid email format) -->
              <span
                v-else-if="form.email && isValidEmail"
                :class="{
                  'text-success': availability.email?.available,
                  'text-error': !availability.email?.available
                }"
                class="text-sm"
              >
                {{ availability.email?.message || 'Checking availability...' }}
              </span>


              <div>
                <label
                  for="name"
                  class="block mb-2 text-sm font-medium"
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
                  class="block mb-2 text-sm font-medium"
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
                  class="block mb-2 text-sm font-medium"
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
                  class="block mb-2 text-sm font-medium"
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
                    @change="openTermsModal"
                    required
                  />
                  <!-- Modal for forced terms of Service-->
                  <dialog ref="termsModal" class="modal">
                    <div class="modal-box">
                      <div class="p-2">
                          <h1 class="text-5xl font-bold mb-4">Terms of Service</h1>
                        
                          <section class="mb-6">
                            <h2 class="text-2xl mt-6 mb-4 font-semibold">1. Introduction</h2>
                            <p>Thank you for visiting this website (the “Site” or “website”). Please read the Terms and Conditions contained in this document carefully since any use of this site constitutes your acceptance of the Terms and Conditions set out herein. If you do not agree to these terms and conditions, you are free to not use this website.</p>
                            <p>This website is created to connect individuals to help adopt and rehome pets and strays. Changes or updates to these Terms and Conditions will be reflected herein.</p>
                          </section>
                        
                          <section class="mb-6">
                            <h2 class="text-2xl mt-6 mb-4 font-semibold">2. User Responsibilities</h2>
                            <ul class="flex flex-col gap-y-2 ml-8 list-decimal">
                              <li><strong>Personal Data:</strong> Personal Information to be provided by the user to create an account should be as accurate as possible. <a href="/privacy-policy" class="text-primary">Privacy Policy</a> is found here.</li>
                              <li><strong>User Responsibility:</strong> Keep in mind that users are responsible for the content that they post. We are not responsible if the information posted here is incomplete or inaccurate. You agree that it is your responsibility to verify to the parties involved to clarify details.</li>
                              <li><strong>Prohibited Activities:</strong> Fraudulent posts, abusive behaviors, offensive content, and illegal activities are prohibited. Users are expected to report such content to create a safe and harmonious community on the platform.</li>
                            </ul>
                          </section>
                        
                          <section class="mb-6">
                            <h2 class="text-2xl mt-6 mb-4 font-semibold">3. Content Ownership</h2>
                            <ul class="flex flex-col gap-y-2 ml-8 list-decimal">
                              <li><strong>Content Ownership:</strong> By posting or submitting any content (including, but not limited to, text, images, videos, or other materials) to this website, you acknowledge and agree that such content will be made public and that it will become the property of Paws'N Claws. You grant Paws'N Claws a perpetual, irrevocable, worldwide license to use, display, and modify the posted content for any purpose.</li>
                              <li><strong>Moderation of Content:</strong> You further acknowledge that the content you post will be accessible by other users of the platform and may be used or shared by those users. Paws'N Claws is under no obligation to keep any content private or confidential, and we reserve the right to remove or modify any content at our discretion.</li>
                            </ul>
                          </section>
                        
                          <section class="mb-6">
                            <h2 class="text-2xl mt-6 mb-4 font-semibold">4. Pet Posting Guidelines</h2>
                            <p class=" ml-8"><strong>Responsibility and Platform Limitation of Liability:</strong> While we strive to maintain a safe and reliable community, we cannot guarantee the accuracy, authenticity, or legitimacy of any adoption offers or listings posted by users. Users are solely responsible for verifying the credibility of such offers and engaging in transactions or interactions at their own discretion.</p>
                          </section>
                        
                          <section class="mb-6">
                            <h2 class="text-2xl mt-6 mb-4 font-semibold">5. Adoption Process</h2>
                            <p>To begin the adoption process, the interested party must click the "Send Application for Adoption" button located under the post of the pet they wish to adopt. They will then be prompted to complete the following information:</p>
                            <ul class="flex flex-col gap-y-1 ml-8 mb-4 list-decimal">
                              <li>Adoption Code</li>
                              <li>Adopter Account</li>
                              <li>Adopter Name</li>
                              <li>Contact Information</li>
                              <li>Adopt Type (Specify whether the adopter is an individual, an organization, a shelter, etc.)</li>
                              <li>Employment Status</li>
                              <li>Social Media Links</li>
                              <li>Location of Adopter</li>
                              <li>Experience with Pets</li>
                              <li>Reason for Adopting</li>
                              <li>Number of Current Pets</li>
                              <li>Government-Issued ID for Identification</li>
                            </ul>
                            <p>Once the application is submitted, the pet’s current owner or organization will review the details before proceeding with the adoption process. This ensures that the adopter is fully prepared and qualified for the responsibility of pet adoption.</p>
                          </section>
                        
                          <section class="mb-6">
                            <h2 class="text-2xl mt-6 mb-4 font-semibold">6. Indemnification</h2>
                            <p class=" ml-8">You agree to indemnify and hold harmless Paws'N Claws, its officers, directors, employees, agents, and affiliates from and against any claims, liabilities, damages, losses, costs, and expenses (including reasonable legal fees) arising out of or related to your use of the platform, your violation of these Terms of Service, or your violation of any rights of another party.</p>
                          </section>
                        
                          <section class="mb-6">
                            <h2 class="text-2xl mt-6 mb-4 font-semibold">7. Termination</h2>
                            <h3 class="text-xl font-semibold ml-8">1. Termination of Access</h3>
                            <p class=" ml-8 mb-4">Paws'N Claws reserves the right to suspend, restrict, or terminate your access to the website and its services at any time, without prior notice, if you violate these Terms of Service or engage in activities deemed harmful to the platform or its users.</p>
                            
                            <h3 class="text-xl font-semibold ml-8">2. Grounds for Account Termination</h3>
                            <ul class="flex flex-col gap-y-2 ml-20 mb-4 list-decimal">
                              <li><strong>Misrepresentation:</strong> Posting false or misleading information about pets, adoption offers, or other users.</li>
                              <li><strong>Fraudulent Activity:</strong> Engaging in scams, deceptive practices, or other fraudulent behavior.</li>
                              <li><strong>Prohibited Content:</strong> Posting content that is defamatory, offensive, abusive, illegal, or violates the rights of others.</li>
                              <li><strong>Harassment:</strong> Engaging in threatening, harassing, or bullying behavior toward other users.</li>
                              <li><strong>Animal Welfare Violations:</strong> Promoting, participating in, or encouraging animal cruelty, illegal breeding, or other unethical practices related to animals.</li>
                              <li><strong>Unauthorized Use:</strong> Using the platform for purposes unrelated to pet adoption or rehoming, such as commercial advertising, spamming, or data scraping.</li>
                              <li><strong>Violation of Laws:</strong> Engaging in any activities on the platform that violate local, state, national, or international laws.</li>
                              <li><strong>Multiple Offenses:</strong> Repeated violations of community guidelines, even after warnings or temporary suspensions.</li>
                              <li><strong>Impersonation:</strong> Creating accounts under false identities or impersonating another individual or organization.</li>
                            </ul>
                            
                            <h3 class="text-xl font-semibold ml-8">3. Consequences of Termination</h3>
                            <p class=" ml-8">Upon termination, your account will be deactivated, and access to your data, posts, or content may be restricted or permanently removed. Paws'N Claws is not obligated to restore or reinstate accounts that have been terminated for violations of these Terms of Service.</p>
                          </section>
                        
                          <section class="mb-6">
                            <h2 class="text-2xl mt-6 mb-4 font-semibold">8. Dispute Resolution</h2>
                            <p class=" ml-8">Any disputes between you and Paws'N Claws arising from your use of the platform or these Terms of Service will first be addressed through informal resolution. If unresolved, disputes will be resolved through binding arbitration under Philippine Dispute Resolution Center, Inc. (PDRCI) rules, governed by the Philippine Laws. Claims must be brought individually, not as part of a class or collective action.</p>
                          </section>
                        
                          <section class="mb-6">
                            <h2 class="text-2xl mt-6 mb-4 font-semibold">9. Miscellaneous</h2>
                            <ul class="flex flex-col gap-y-2 ml-8 list-decimal">
                              <li><strong>Severability:</strong> If any provision of these Terms of Service is determined to be invalid, illegal, or unenforceable by a court of competent jurisdiction, such provision shall be deemed severed from these Terms, and the remaining provisions shall continue in full force and effect.</li>
                              <li><strong>Entire Agreement:</strong> These Terms of Service, along with any other agreements, policies, or notices published by Paws'N Claws on the website, represent the complete and exclusive agreement between you and Paws'N Claws regarding your use of the platform.</li>
                              <li><strong>Force Majeure:</strong> Paws'N Claws shall not be held liable or responsible for any failure or delay in performance of its obligations under these Terms of Service if such failure or delay is caused by events beyond our reasonable control.</li>
                            </ul>
                          </section>
                        
                          <section class="mb-6">
                            <h2 class="text-2xl mt-6 mb-4 font-semibold">Copyright Infringement Disclaimer</h2>
                            <p>Paws'N Claws respects intellectual property rights. By posting content, you confirm that you own or have the necessary rights to use and share it. You agree to indemnify Paws'N Claws from any claims, damages, or liabilities arising from copyright infringement related to your content.</p>
                            <p>If you believe your copyright has been infringed, please contact us at <a href="mailto:ad.official.pawsnclaws@gmail.com" class="text-primary">ad.official.pawsnclaws@gmail.com</a>, and we will take appropriate action, including removal or restriction of access to the infringing content.</p>
                          </section>
                      </div>
                      <div class="modal-action">
                        <form method="dialog">
                          <button class="btn btn-success" @click="closeTermsModal">I Accept</button>
                        </form>
                      </div>
                    </div>
                  </dialog>
                </div>
                <div class="ml-3 text-sm">
                  <label for="terms" class="font-light"
                    >I accept the
                    <a
                      class="font-medium text-primary-600 text-secondary underline hover:underline dark:text-primary-500"
                      href="/pages/terms-and-conditions"
                      >Terms of Service</a
                    ></label
                  >
                </div>
              </div>
              <div class="flex items-start">
                <div class="flex items-center h-5">
                  <input
                    id="privacy"
                    type="checkbox"
                    v-model="form.privacy"
                    class="checkbox checkbox-base-100"
                    @change="openPrivacyModal"
                    required
                  />
                  <!-- Modal for forced terms of Service-->
                  <dialog ref="privacyModal" class="modal">
                    <div class="modal-box">
                      <div class="p-2">
                        <h2 class="text-5xl font-bold mb-4">Privacy Policy</h2>
                          <p class="text-lg mb-4">Effective Date: December 7, 2024</p>
                          <p class="mb-4">Paws’N Claws PH Community Hub ("we," "our," or "us") values your privacy and is committed to protecting your personal data. This Privacy Policy explains how we collect, use, and safeguard your information when you use our services.</p>
                          <p class="mb-4">By using our website, you agree to the terms of this Privacy Policy. If you do not agree, you may discontinue using our site.</p>
                    
                        <h3 class="text-2xl font-semibold mt-6 mb-4">1. Information We Collect</h3>
                          <p class="mb-4">We may collect the following types of personal data:</p>
                            <ul class="list-inside list-decimal">
                              <li class="mb-2"><strong>Account Creation and Sign-In</strong><br>Information collected: Name, email address, phone number, organization name (if applicable), and password.<br>Purpose: To create and manage your account, provide access to services, and verify your identity.</li>
                              <li class="mb-2"><strong>Promotions and Notifications</strong><br>Information collected: Email address, phone number (for SMS).<br>Purpose: To send updates, promotional offers, and notifications you have opted in to receive.</li>
                              <li class="mb-2"><strong>Location Information</strong><br>Information collected: GPS location or IP-based location data.<br>Purpose: To display adoptable animals nearby or help connect you with users in your vicinity.<br>Consent: We will ask for permission before accessing your location.</li>
                              <li class="mb-2"><strong>Donations</strong><br>Information collected: Name, organization name (if applicable), email address, and payment details (payment method, transaction ID).<br>Purpose: To process your donation and provide receipts or confirmations.</li>
                              <li class="mb-2"><strong>Customer Feedback</strong><br>Information collected: Feedback and responses through surveys, forms, or chat interactions.<br>Purpose: To improve our services based on your input.</li>
                              <li class="mb-2"><strong>User Preferences</strong><br>Information collected: Behavioral data such as browsing habits, search queries, and interaction with the website.<br>Purpose: To personalize your experience and suggest relevant content.</li>
                              <li class="mb-2"><strong>Data from Third-Party Platforms</strong><br>Information collected: Profile information from accounts linked through Gmail, Facebook, or other social platforms (e.g., name, profile picture, email).<br>Purpose: To streamline account creation and login.</li>
                            </ul>
                    
                        <h3 class="text-2xl font-semibold mt-6 mb-4">2. How We Use Your Information</h3>
                          <p class="mb-4">We use your information to:</p>
                            <ul class="list-inside list-decimal">
                              <li class="mb-2">Provide and improve our services.</li>
                              <li class="mb-2">Personalize your user experience.</li>
                              <li class="mb-2">Communicate with you regarding promotions, updates, or feedback.</li>
                              <li class="mb-2">Ensure the security of our platform.</li>
                              <li class="mb-2">Comply with legal obligations.</li>
                            </ul>
                    
                        <h3 class="text-2xl font-semibold mt-6 mb-4">3. Data Protection</h3>
                          <p class="mb-4">We take your privacy seriously and implement appropriate technical and organizational measures to safeguard your personal data, including encryption and secure server protocols. However, no online service is completely secure. While we strive to protect your data, we cannot guarantee its absolute security.</p>
                    
                        <h3 class="text-2xl font-semibold mt-6 mb-4">4. Sharing Your Information</h3>
                          <p class="mb-4">We do not sell or share your personal data with third parties for their marketing purposes. We may share information with:</p>
                            <ul class="list-inside list-decimal">
                              <li class="mb-2">Service Providers: Trusted vendors to support our operations (e.g., payment processors).</li>
                              <li class="mb-2">Legal Authorities: If required by law or to protect our rights.</li>
                            </ul>
                    
                        <h3 class="text-2xl font-semibold mt-6 mb-4">5. Your Rights</h3>
                          <p class="mb-4">You have the right to:</p>
                            <ul class="list-inside list-decimal">
                              <li class="mb-2">Access, update, or delete your personal data.</li>
                              <li class="mb-2">Withdraw consent for specific data uses (e.g., location tracking or marketing).</li>
                              <li class="mb-2">Request a copy of your data in a portable format.</li>
                            </ul>
                          <p class="mb-4">To exercise these rights, contact us at [Insert Contact Information].</p>
                    
                        <h3 class="text-2xl font-semibold mt-6 mb-4">6. Data Retention</h3>
                          <p class="mb-4">We retain your information for as long as necessary to fulfill the purposes outlined in this policy, unless a longer retention period is required by law.</p>
                    
                        <h3 class="text-2xl font-semibold mt-6 mb-4">7. Updates to this Privacy Policy</h3>
                          <p class="mb-4">We may update this policy from time to time. Changes will be posted on this page with the "Effective Date" updated. If changes are significant, we will notify you via email or a website banner.</p>
                    
                        <h3 class="text-2xl font-semibold mt-6 mb-4">8. Contact Us</h3>
                          <p class="mb-4">If you have any questions or concerns about this Privacy Policy, contact us at:</p>
                          <p class="mb-4">Email: example_pawsandclaws@gmail.com</p>
                    
                          <p class="mt-6">This Privacy Policy ensures transparency and demonstrates our commitment to protecting your personal data.</p>
                      </div>
                      <div class="modal-action">
                        <form method="dialog">
                          <button class="btn btn-success" @click="closeTermsModal">I Accept</button>
                        </form>
                      </div>
                    </div>
                  </dialog>
                </div>
                <div class="ml-3 text-sm">
                  <label for="terms" class="font-light"
                    >I accept the
                    <a
                      class="font-medium text-primary-600 text-secondary underline hover:underline dark:text-primary-500"
                      href="/pages/terms-and-conditions"
                      >Privacy Policy</a
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
              <p class="text-sm font-light">
                Already have an account?
                <a
                  href="/login"
                  class="font-medium text-primary-600 hover:underline dark:text-primary-500 text-secondary underlined"
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
                  <p class="text-sm">Didn't receive the code?</p>
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

            <!-- Email Verified Success Modal -->
            <div
              v-if="showSuccessModal"
              class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            >
              <div class="bg-base-100 p-6 rounded-lg shadow-lg w-[90%] max-w-sm text-center">
                <h2 class="text-xl font-bold text-success mb-2">🎉 Verified!</h2>
                <p class="text-sm">
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
        privacy: false,
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
    openTermsModal(e) {
      if (e.target.checked) {
        this.$refs.termsModal.showModal();
      }
    },
    closeTermsModal() {
      this.$refs.termsModal.close();
    },
    openPrivacyModal(e) {
      if (e.target.checked) {
        this.$refs.privacyModal.showModal();
      }
    },
    closePrivacyModal() {
      this.$refs.privacyModal.close();
    },
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
