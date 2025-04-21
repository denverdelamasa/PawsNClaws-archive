<section class="body-font w-full">
    <div class="container px-5 py-12 mx-auto">
        <div class="flex flex-col text-center w-full mb-4">
            <h1 class="sm:text-4xl text-3xl font-bold title-font">Posts Management</h1>
            <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
              View, filter, and manage all user-generated posts from this table.
            </p>
        </div>

        <div class="mb-4 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
          <div class="flex items-center gap-2">
            <details class="dropdown">
              <summary class="btn btn-sm">Filter</summary>
              <ul class="menu dropdown-content bg-base-100 rounded-box z-10 w-52 p-2 shadow">
                <li><a>Image Posts</a></li>
                <li><a>Text Only</a></li>
                <li><a>By User</a></li>
                <li><a>Reported</a></li>
              </ul>
            </details>
            <input
              type="text"
              placeholder="Search posts..."
              class="input input-bordered input-sm w-full max-w-xs"
            />
          </div>
          <button class="btn btn-primary btn-sm">+ Create New Post</button>
        </div>
        
        <div class="overflow-x-auto">
          <table class="table">
            <!-- head -->
            <thead>
              <tr>
                <th>User</th>
                <th>Caption</th>
                <th>Image</th>
                <th>Date Posted</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <!-- Example Row -->
              <tr>
                <td>
                  <div class="flex items-center gap-3">
                    <div class="avatar">
                      <div class="mask mask-squircle w-12 h-12">
                        <img src="" alt="Thumbnail" />
                      </div>
                    </div>
                    <div>
                      <div class="font-bold">doglover99</div>
                      <div class="text-sm opacity-50">Regular User</div>
                    </div>
                  </div>
                </td>
                <td>Meet Bruno, the goofiest pup ever!</td>
                <td><img src="https://place-puppy.com/100x100" class="rounded w-16 h-16 object-cover" /></td>
                <td>2025-04-10</td>
                <th>
                  <button class="btn btn-primary btn-xs" onclick="post_modal_1.showModal()">details</button>
                </th>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <th>User</th>
                <th>Caption</th>
                <th>Image</th>
                <th>Date Posted</th>
                <th></th>
              </tr>
            </tfoot>
          </table>
        </div>
        
        <dialog id="post_modal_1" class="modal">
          <div class="modal-box">
            <form method="dialog">
              <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="text-lg font-bold">Post by doglover99</h3>
            <p class="py-2">"Meet Bruno, the goofiest pup ever!"</p>
            <img src="https://place-puppy.com/300x200" class="rounded-box" />
            <div class="mt-4 flex justify-end gap-2">
              <button class="btn btn-error btn-sm">Delete</button>
              <button class="btn btn-outline btn-sm">Edit</button>
            </div>
          </div>
        </dialog>
    </div>
</section>

<section class="body-font w-full">
  <div class="container px-5 py-12 mx-auto">
    <!-- Header -->
    <div class="flex flex-col text-center w-full mb-4">
      <h1 class="sm:text-4xl text-3xl font-bold title-font">Announcements Management</h1>
      <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
        View, filter, and manage all site-wide announcements from here.
      </p>
    </div>

    <!-- Controls: Filter, Search, Create -->
    <div class="mb-4 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
      <div class="flex items-center gap-2">
        <details class="dropdown">
          <summary class="btn btn-sm">Filter</summary>
          <ul class="menu dropdown-content bg-base-100 rounded-box z-10 w-52 p-2 shadow">
            <li><a>Published</a></li>
            <li><a>Drafts</a></li>
            <li><a>Scheduled</a></li>
          </ul>
        </details>
        <input
          type="text"
          placeholder="Search announcements..."
          class="input input-bordered input-sm w-full max-w-xs"
        />
      </div>
      <button class="btn btn-primary btn-sm">+ New Announcement</button>
    </div>

    <!-- Announcements Table -->
    <div class="overflow-x-auto">
      <table class="table">
        <thead>
          <tr>
            <th>Title</th>
            <th>Uploader</th>
            <th>Date Published</th>
            <th>Thumbnail</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <!-- Sample Row -->
          <tr>
            <td>Spring Adoption Drive</td>
            <td>
              <div class="flex items-center gap-3">
                <div class="avatar">
                  <div class="mask mask-squircle w-10 h-10">
                    <img src="https://i.pravatar.cc/40?img=12" alt="Uploader avatar" />
                  </div>
                </div>
                <div>
                  <div class="font-bold">shelter_sunnyhome</div>
                  <div class="text-sm opacity-50">Shelter Account</div>
                </div>
              </div>
            </td>
            <td>2025-04-12</td>
            <td><img src="https://placekitten.com/80/80" class="rounded w-16 h-16 object-cover" alt="Announcement image" /></td>
            <th>
              <button class="btn btn-primary btn-xs" onclick="announcement_modal_1.showModal()">details</button>
            </th>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <th>Title</th>
            <th>Uploader</th>
            <th>Date Published</th>
            <th>Thumbnail</th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>

    <!-- Details Modal -->
    <dialog id="announcement_modal_1" class="modal">
      <div class="modal-box">
        <form method="dialog">
          <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="text-lg font-bold mb-2">Announcement: Spring Adoption Drive</h3>
        <p><span class="font-semibold">Uploader:</span> shelter_sunnyhome (Shelter Account)</p>
        <p><span class="font-semibold">Published:</span> 2025-04-12</p>
        <p class="mt-4">Join us for our annual Spring Adoption Drive! Find your new best friend and support local shelters.</p>
        <img src="https://placekitten.com/300/200" class="rounded-box my-4" alt="Announcement full image" />
        <div class="mt-4 flex justify-end gap-2">
          <button class="btn btn-error btn-sm">Delete</button>
          <button class="btn btn-outline btn-sm">Edit</button>
        </div>
      </div>
    </dialog>
  </div>
</section>

<section class="body-font w-full">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-4">
      <h1 class="sm:text-4xl text-3xl font-bold title-font">Events Management</h1>
      <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
        View, filter, and manage all shelter-created events from this table.
      </p>
    </div>

    <div class="mb-4 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
      <div class="flex items-center gap-2">
        <details class="dropdown">
          <summary class="btn btn-sm">Filter</summary>
          <ul class="menu dropdown-content bg-base-100 rounded-box z-10 w-52 p-2 shadow">
            <li><a>Upcoming</a></li>
            <li><a>Ongoing</a></li>
            <li><a>Past</a></li>
            <li><a>By Shelter</a></li>
          </ul>
        </details>
        <input
          type="text"
          placeholder="Search events..."
          class="input input-bordered input-sm w-full max-w-xs"
        />
      </div>
      <button class="btn btn-primary btn-sm">+ Create New Event</button>
    </div>

    <div class="overflow-x-auto">
      <table class="table">
        <!-- head -->
        <thead>
          <tr>
            <th>Title</th>
            <th>Shelter</th>
            <th>Image</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <!-- Example Row -->
          <tr>
            <td>Adopt-A-Pet Day</td>
            <td>
              <div class="flex items-center gap-3">
                <div class="avatar">
                  <div class="mask mask-squircle w-12 h-12">
                    <img src="https://placekitten.com/100/100" alt="Shelter Thumbnail" />
                  </div>
                </div>
                <div>
                  <div class="font-bold">Happy Paws Shelter</div>
                  <div class="text-sm opacity-50">Shelter Account</div>
                </div>
              </div>
            </td>
            <td><img src="https://placekitten.com/100/80" class="rounded w-16 h-16 object-cover" /></td>
            <td>2025-05-01</td>
            <td>2025-05-03</td>
            <th>
              <button class="btn btn-primary btn-xs" onclick="event_modal_1.showModal()">details</button>
            </th>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <th>Title</th>
            <th>Shelter</th>
            <th>Image</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>

    <dialog id="event_modal_1" class="modal">
      <div class="modal-box">
        <form method="dialog">
          <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="text-lg font-bold">Adopt-A-Pet Day</h3>
        <p class="py-2">Join us for a weekend filled with furry friends and find your forever companion!</p>
        <img src="https://placekitten.com/300/200" class="rounded-box my-2" />
        <p><span class="font-semibold">Start Date:</span> May 1, 2025</p>
        <p><span class="font-semibold">End Date:</span> May 3, 2025</p>
        <p><span class="font-semibold">Uploaded by:</span> Happy Paws Shelter</p>
        <div class="mt-4 flex justify-end gap-2">
          <button class="btn btn-error btn-sm">Delete</button>
          <button class="btn btn-outline btn-sm">Edit</button>
        </div>
      </div>
    </dialog>
  </div>
</section>
