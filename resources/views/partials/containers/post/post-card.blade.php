<div class="card bg-base-200 w-full shadow-xl my-4 border border-base-300">
  <!-- Header with Title and Menu -->
  <div class="flex justify-end items-end p-4">
    <!-- Dropdown Menu -->
    <div class="dropdown dropdown-end">
      <label tabindex="0" class="btn btn-sm btn-ghost">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
          <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
        </svg>
      </label>
      <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-300 rounded-box w-40">
        <li><a href="#">Edit Post</a></li>
        <li><a href="#">Delete Post</a></li>
        <li><a href="#">Report</a></li>
      </ul>
    </div>
  </div>

  <!-- Thumbnail -->
  <div class="px-4 hover:cursor-pointer" onclick="my_modal_1.showModal()">
    <img src="https://picsum.photos/1080/1920" alt="Thumbnail" class="w-full max-h-[400px] rounded object-cover" />
  </div>
  <!-- Modal Thumbnail -->
  <dialog id="my_modal_1" class="modal">
    <div class="modal-box">
      <h3 class="text-lg font-bold">Hello!</h3>
      <p class="py-4">Press ESC key or click the button below to close</p>
      <div class="modal-action">
        <form method="dialog">
          <!-- if there is a button in form, it will close the modal -->
          <button class="btn">Close</button>
        </form>
      </div>
    </div>
  </dialog>

  <!-- Card Body -->
  <div class="card-body pt-2">
    <div class="card-body">
      <!-- Title -->
      <h2 class="card-title text-2xl font-bold">
        Anyone Interested in Adopting My 100-Year-Old Magical Dog?
      </h2>
      <div class="text-base mt-2 relative">
        <!-- Truncated Content -->
        <p id="description" class="line-clamp-3 text-base transition-all duration-300">
          Imagine coming home from work to find something extraordinary—a glowing puppy! 
          Yes, you read that right, glowing. I have no idea why or how this happened, but here we are. 
          I can’t just abandon it, that’s not an option. It’s an incredibly sweet and friendly little thing, 
          and now it needs a home. If you're looking for a magical (and very unique) companion, 
          this glowing pup might just be the one for you. Any takers?
        </p>
        <!-- See More Button -->
        <button id="toggleBtn" class="btn btn-link btn-xs text-sm mt-2 px-0">
          See More
        </button>
      </div>
      <!-- Buttons -->
      <div class="flex gap-2 flex-wrap">
        <!-- Upvote Button -->
        <button class="btn bg-warning btn-sm">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-5 w-5 stroke-current">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10V21H10V10L5.5 10L12 3.5L18.5 10H14Z" />
          </svg>
          <p>4.5k</p>
          Upvotes
        </button>

        <!-- Downvote Button -->
        <button class="btn btn-error btn-sm">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-5 w-5 stroke-current">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14V3H14V14L18.5 14L12 20.5L5.5 14H10Z" />
          </svg>
          Downvote
        </button>

        <!-- Comments Button -->
        <button id="commentsBtn" class="btn btn-outline btn-sm flex gap-1 items-center" onclick="commentsModal.showModal()">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-5 w-5 stroke-current">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8H7M17 12H7M9 16H15M5 5V19L10 14H19C19.5523 14 20 13.5523 20 13V6C20 5.44772 19.5523 5 19 5H5Z" />
          </svg>
          <span>Comments</span>
        </button>
  
        @include('partials.containers.input.comments-modal')
              
  
        <!-- Bookmark Button -->
        <button id="bookmarkBtn" class="btn btn-outline btn-sm flex items-center gap-2">
          <svg id="bookmarkIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-plus" viewBox="0 0 16 16">
            <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/>
            <path d="M8 4a.5.5 0 0 1 .5.5V6H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1 0-1h1.5V4.5A.5.5 0 0 1 8 4"/>
          </svg>
          <span id="bookmarkText">Add to bookmarks</span>
        </button>
      </div>       
    </div>
  </div>
</div>
<script>
  const bookmarkBtn = document.getElementById('bookmarkBtn');
  const bookmarkIcon = document.getElementById('bookmarkIcon');
  const bookmarkText = document.getElementById('bookmarkText');

  bookmarkBtn.addEventListener('click', () => {
    // Check the current state of the button text and icon
    if (bookmarkText.textContent === 'Add to bookmarks') {
      // Change to "Remove from bookmarks" state
      bookmarkIcon.setAttribute('class', 'bi bi-bookmark-fill');  // Change icon class
      bookmarkText.textContent = 'Remove from bookmarks'; // Change button text
      bookmarkBtn.classList.remove('btn-outline');
      bookmarkBtn.classList.add('btn-primary');
    } else {
      // Change back to "Add to bookmarks" state
      bookmarkIcon.setAttribute('class', 'bi bi-bookmark-plus');  // Reset icon class
      bookmarkText.textContent = 'Add to bookmarks'; // Reset button text
      bookmarkBtn.classList.remove('btn-primary');
      bookmarkBtn.classList.add('btn-outline');
    }
  });

  const toggleBtn = document.getElementById('toggleBtn');
  const description = document.getElementById('description');

  toggleBtn.addEventListener('click', () => {
    if (description.classList.contains('line-clamp-3')) {
      description.classList.remove('line-clamp-3');  // Remove truncation
      toggleBtn.textContent = 'See Less';  // Change button text
    } else {
      description.classList.add('line-clamp-3');  // Reapply truncation
      toggleBtn.textContent = 'See More';  // Change button text
    }
  });

  //responsiveness to ng mga modals, sub modals, tsaka buttons
</script>

