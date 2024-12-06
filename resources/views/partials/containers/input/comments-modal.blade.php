<!-- DaisyUI Modal (hidden by default) YUNG COMMENT MODAL
<input type="checkbox" id="commentModal" class="modal-toggle" />
<label for="commentModal" class="modal cursor-pointer" id="modal-background">

</label>-->

<dialog id="commentsModal" class="modal">
    <div class="modal-box relative max-w-full w-9/12 h-screen p-8 scrollbar-hidden overflow-auto">
        <h3 class="text-xl font-bold my-4">Comments</h3>
        <!-- Comment Input -->
        <textarea placeholder="Write a comment..." class="textarea textarea-bordered w-full resize-y" rows="2"></textarea>
        <button class="btn btn-primary mt-4 btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
            </svg>
            Post Comment
        </button>
        <div class="comment-section mt-4">
            <!-- Sample Comment -->
            <div class="mt-4 bg-base-300 p-4 rounded-r-xl rounded-b-xl my-4 relative">
            <!-- Dropdown Menu -->
            <div class="dropdown dropdown-end absolute right-4 top-4">
                <label tabindex="0" class="btn btn-sm btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                    <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
                </svg>
                </label>
                <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-300 rounded-box w-40">
                <li><a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-flag" viewBox="0 0 16 16">
                        <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21 21 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21 21 0 0 0 14 7.655V1.222z"/>
                    </svg>
                    Report Comment
                </a></li>
                </ul>
            </div>
                
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

                <p class="text-base transition-all duration-300">
                    This is a sample comment inside the modal. The user can leave their thoughts here regarding the post or event! Whether it's feedback, questions, or just sharing their opinions, this is a space for open conversation. Feel free to express yourself and engage with others in the community. Your thoughts matter, and we encourage everyone to contribute to the discussion in a respectful and positive way. Don’t hesitate to share any ideas or suggestions you may have — we value all input and appreciate your participation!
                </p>

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

        </div>
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
    </div>
</dialog>