<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @include('partials.main.data-theme')>
@include('partials.main.scripts-styles')
    <body class="font-sans antialiased">
        @include('partials.main.navbar')
        <div class="container mx-auto p-4">
          <div class="card bg-base-300 shadow-md p-24">
            <h2 class="text-5xl font-bold mb-4">Privacy Policy</h2>
              <p class="text-lg mb-4">Effective Date: December 7, 2024</p>
              <p class="mb-4">Paws’N Claws PH Community Hub ("we," "our," or "us") values your privacy and is committed to protecting your personal data. This Privacy Policy explains how we collect, use, and safeguard your information when you use our services.</p>
              <p class="mb-4">By using our website, you agree to the terms of this Privacy Policy. If you do not agree, you may discontinue using our site.</p>
        
            <h3 class="text-2xl font-semibold mt-6 mb-4">1. Information We Collect</h3>
              <p class="mb-4">We may collect the following types of personal data:</p>
                <ul class="list-inside list-decimal">
                  <li class="mb-2"><strong>a. Account Creation and Sign-In</strong><br>Information collected: Name, email address, phone number, organization name (if applicable), and password.<br>Purpose: To create and manage your account, provide access to services, and verify your identity.</li>
                  <li class="mb-2"><strong>b. Promotions and Notifications</strong><br>Information collected: Email address, phone number (for SMS).<br>Purpose: To send updates, promotional offers, and notifications you have opted in to receive.</li>
                  <li class="mb-2"><strong>c. Location Information</strong><br>Information collected: GPS location or IP-based location data.<br>Purpose: To display adoptable animals nearby or help connect you with users in your vicinity.<br>Consent: We will ask for permission before accessing your location.</li>
                  <li class="mb-2"><strong>d. Donations</strong><br>Information collected: Name, organization name (if applicable), email address, and payment details (payment method, transaction ID).<br>Purpose: To process your donation and provide receipts or confirmations.</li>
                  <li class="mb-2"><strong>e. Customer Feedback</strong><br>Information collected: Feedback and responses through surveys, forms, or chat interactions.<br>Purpose: To improve our services based on your input.</li>
                  <li class="mb-2"><strong>f. User Preferences</strong><br>Information collected: Behavioral data such as browsing habits, search queries, and interaction with the website.<br>Purpose: To personalize your experience and suggest relevant content.</li>
                  <li class="mb-2"><strong>g. Data from Third-Party Platforms</strong><br>Information collected: Profile information from accounts linked through Gmail, Facebook, or other social platforms (e.g., name, profile picture, email).<br>Purpose: To streamline account creation and login.</li>
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
        </div>        
    </body>

    <footer class="footer bg-base-300 text-base-content p-4 text-xs">
        <nav>
          <h6 class="footer-title text-xs">Contents</h6>
          <a class="link link-hover">Posts</a>
          <a class="link link-hover">Announcements</a>
          <a class="link link-hover">Events</a>
          <a class="link link-hover">Shelters</a>
        </nav>
        <nav>
          <h6 class="footer-title text-xs">Site</h6>
            @guest
                <a class="link link-hover" href="{{ url('form/login') }}">Log in</a>
                <a class="link link-hover" href="{{ url('form/signup') }}>Sign Up</a>
            @endguest
          <a class="link link-hover">About us</a>
          <a class="link link-hover">Contact</a>
          <a class="link link-hover">Apply</a>
        </nav>
        <nav>
          <h6 class="footer-title text-xs">Legal</h6>
          <a class="link link-hover" href="{{ url('terms-of-service') }}">Terms of Service</a>
          <a class="link link-hover" href="{{ url('privacy-policy') }}">Privacy policy</a>
          
        </nav>
    </footer>
    <footer class="footer bg-base-300 text-base-content border-base-300 border-t px-10 py-4">
        <aside class="grid-flow-col items-center">
            <p>
              Paws'N Claws 
            </p>
        </aside>
        <nav class="md:place-self-center md:justify-self-end">
            <div class="grid grid-flow-col gap-4">
            <a>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current">
                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path>
                </svg>
            </a>
            <a>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current">
                    <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"></path>
                </svg>
            </a>
            <a>
                <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                class="fill-current">
                <path
                    d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path>
                </svg>
            </a>
            </div>
        </nav>
    </footer>
</html>
<style>
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