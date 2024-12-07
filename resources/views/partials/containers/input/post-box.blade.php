<div class="card bg-base-200 shadow-md w-full max-w-full border border-base-300 p-4">
    <div class="flex items-start gap-4" id="observedDiv">
      <!-- Profile Picture -->
      <img
        src="https://picsum.photos/200"
        alt="Profile"
        class="w-12 h-12 rounded-full">
      <!-- Input and Buttons -->
      <div class="flex-grow">
        <div onclick="postboxModal.showModal()" class="flex items-center justify-start bg-base-300 p-3 rounded-full hover:bg-base-100 duration-200 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil mr-2" viewBox="0 0 16 16">
                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
            </svg>
            What do you want to share?
        </div>
        <div class=" border-b border-b-base-100 my-2 py-2">        

        </div>
        <div class="mt-2 flex gap-2 flex-wrap">
            <button class="btn btn-primary btn-sm" id="btnPost" onclick="postboxModal.showModal()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                </svg>
                Post
            </button>
            <button class="btn btn-accent btn-sm" onclick="postboxModal.showModal()" id="btnAnnouncement">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-megaphone" viewBox="0 0 16 16">
                    <path d="M13 2.5a1.5 1.5 0 0 1 3 0v11a1.5 1.5 0 0 1-3 0v-.214c-2.162-1.241-4.49-1.843-6.912-2.083l.405 2.712A1 1 0 0 1 5.51 15.1h-.548a1 1 0 0 1-.916-.599l-1.85-3.49-.202-.003A2.014 2.014 0 0 1 0 9V7a2.02 2.02 0 0 1 1.992-2.013 75 75 0 0 0 2.483-.075c3.043-.154 6.148-.849 8.525-2.199zm1 0v11a.5.5 0 0 0 1 0v-11a.5.5 0 0 0-1 0m-1 1.35c-2.344 1.205-5.209 1.842-8 2.033v4.233q.27.015.537.036c2.568.189 5.093.744 7.463 1.993zm-9 6.215v-4.13a95 95 0 0 1-1.992.052A1.02 1.02 0 0 0 1 7v2c0 .55.448 1.002 1.006 1.009A61 61 0 0 1 4 10.065m-.657.975 1.609 3.037.01.024h.548l-.002-.014-.443-2.966a68 68 0 0 0-1.722-.082z"/>
                </svg>
                Announcement
            </button>
            <button class="btn btn-info btn-sm" onclick="postboxModal.showModal()" id="btnEvent">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar2-plus" viewBox="0 0 16 16">
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z"/>
                    <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5zM8 8a.5.5 0 0 1 .5.5V10H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V11H6a.5.5 0 0 1 0-1h1.5V8.5A.5.5 0 0 1 8 8"/>
                </svg>
                Event
            </button>
        </div>
      </div>
    </div>
</div>
<!-- Modal -->
<dialog id="postboxModal" class="modal">
    <div class="modal-box">
        <form id="postForm">
            <button type="button" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" onclick="document.getElementById('postboxModal').close();">✕</button>
            <h3 id="modalTitle" class="text-lg font-bold mb-4">Create Post</h3>

            <!-- Common Fields -->
            <div id="commonFields">
                <!-- Write Something (Visible only for Post) -->
                <textarea id="postText" class="textarea textarea-bordered w-full resize-none mb-4 hidden" rows="3" placeholder="Write something..."></textarea>
                <div>
                    <button id="btnThumbnail" type="button" class="btn btn-primary btn-sm mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                            <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                            <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1z"/>
                        </svg>
                        Add Thumbnail
                    </button>
                </div>
            </div>

            <!-- Announcement Fields -->
            <div id="announcementFields" class="hidden">
                <input type="text" class="input input-bordered w-full mb-4" placeholder="Announcement Title" />
                <textarea class="textarea textarea-bordered w-full resize-none mb-4" rows="3" placeholder="Announcement Details"></textarea>
            </div>

            <!-- Event Fields -->
            <div id="eventFields" class="hidden">
                <input type="text" class="input input-bordered w-full mb-4" placeholder="Event Name" />
                <textarea class="textarea textarea-bordered w-full resize-none mb-4" rows="3" placeholder="Event Description"></textarea>
                <input type="date" class="input input-bordered w-full mb-4" />
                <input type="text" class="input input-bordered w-full mb-4" placeholder="Event Location" />
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-full">Submit</button>
        </form>
    </div>
</dialog>


<!--
    document.addEventListener("DOMContentLoaded", () => {
        const modal = document.getElementById("postboxModal");
        const modalTitle = document.getElementById("modalTitle");
        const commonFields = document.getElementById("commonFields");
        const postText = document.getElementById("postText");
        const announcementFields = document.getElementById("announcementFields");
        const eventFields = document.getElementById("eventFields");

        // Buttons
        const btnPost = document.getElementById("btnPost");
        const btnAnnouncement = document.getElementById("btnAnnouncement");
        const btnEvent = document.getElementById("btnEvent");

        // Event Handlers
        const openModal = (type) => {
            // Reset all fields
            postText.classList.add("hidden");
            announcementFields.classList.add("hidden");
            eventFields.classList.add("hidden");

            // Customize based on the type
            if (type === "post") {
                modalTitle.textContent = "Create Post";
                postText.classList.remove("hidden");
            } else if (type === "announcement") {
                modalTitle.textContent = "Create Announcement";
                announcementFields.classList.remove("hidden");
            } else if (type === "event") {
                modalTitle.textContent = "Create Event";
                eventFields.classList.remove("hidden");
            }

            // Open the modal
            modal.showModal();
        };

        // Attach event listeners
        btnPost.addEventListener("click", () => openModal("post"));
        btnAnnouncement.addEventListener("click", () => openModal("announcement"));
        btnEvent.addEventListener("click", () => openModal("event"));
    });

-->