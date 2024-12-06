<!-- DaisyUI Modal (hidden by default) YUNG COMMENT MODAL
<input type="checkbox" id="commentModal" class="modal-toggle" />
<label for="commentModal" class="modal cursor-pointer" id="modal-background">

</label>-->

<dialog id="commentsModal" class="modal">
    <div class="modal-box relative max-w-full w-9/12 h-screen p-8">
        <h3 class="text-xl font-bold">Comments</h3>
        <div class="comment-section mt-4">

            <!-- Sample Comment -->
            <div class="mt-4 bg-base-300 p-4 rounded-r-xl rounded-b-xl my-4">
                <div class="flex items-center space-x-3">
                    <div class="avatar">
                        <div class="w-12 h-12 rounded-full">
                            <img src="https://picsum.photos/200" alt="User Avatar">
                        </div>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">John Doe</p>
                        <div class="text-xs">
                            <span>Posted on: December 6, 2024</span>
                            <span class="mx-1">|</span>
                            <span>Edited on: December 6, 2024</span>
                        </div>
                    </div>
                </div>
            
                <p class="mt-2">
                    
                </p>    
                <p id="description" class="line-clamp-3 text-base transition-all duration-300">
                    This is a sample comment inside the modal. The user can leave their 
                    thoughts here regarding the post or event!
                </p>
                <!-- See More Button -->
                <button id="toggleBtn" class="btn btn-link btn-xs text-sm mt-2 px-0">
                    See More
                </button>

                <div class="flex gap-2 my-2">
                    <button class="btn bg-warning btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-5 w-5 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10V21H10V10L5.5 10L12 3.5L18.5 10H14Z" />
                    </svg>
                    <p>4.5k</p>
                    Upvotes
                    </button>
            
                    <button class="btn btn-error btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-5 w-5 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14V3H14V14L18.5 14L12 20.5L5.5 14H10Z" />
                    </svg>
                    Downvote
                    </button>
                </div>
            </div>

            <!-- Comment Input -->
            <textarea placeholder="Write a comment..." class="textarea textarea-bordered w-full resize-none" rows="2"></textarea>
            <button class="btn btn-primary mt-4 btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                </svg>
                Post Comment
            </button>
        </div>

        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
    </div>
</dialog>