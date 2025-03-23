<div class="h-full w-full bg-base-100 overflow-auto gap-4 p-6 flex flex-col">
    
    <!-- Users -->
    <div class="flex flex-col m-2 p-2 border-b-2 border-base-300">
        <div class="flex gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-12 h-12" viewBox="0 0 16 16">
                <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6m5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1z"/>
            </svg>
            <h2 class="text-5xl font-bold">Accounts</h2>
        </div>
        <p class="text-lg mb-2">Explore user accounts and connect with the community.</p>
        @for ($i = 0; $i < 3; $i++)
            <div class="m-6 flex card card-side bg-base-200 shadow-sm border border-base-300 px-6 hover:scale-105 transition-transform duration-200">
                <figure class="m-auto w-16 h-16 rounded-full overflow-hidden">
                    <img
                        src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.webp"
                        alt="User Avatar"
                        class="w-full h-full object-cover" />
                </figure>
                <div class="card-body">
                    <h2 class="card-title">Wane Danvers</h2>
                    <p>Hellow! ako po ay isang bolenkey!</p>
                    <!-- Inde ko alam kung pano yung mag ccut sya pag over flow yung naka "..." yung dulo? inde ko alam HAGSHAHA  -->
                    <ul class="flex flex-wrap gap-x-2 gap-y-2">
                        <div class="badge badge-accent">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4" viewBox="0 0 16 16">
                                <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5q0 .807-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33 33 0 0 1 2.5.5m.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935m10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935M3.504 1q.01.775.056 1.469c.13 2.028.457 3.546.87 4.667C5.294 9.48 6.484 10 7 10a.5.5 0 0 1 .5.5v2.61a1 1 0 0 1-.757.97l-1.426.356a.5.5 0 0 0-.179.085L4.5 15h7l-.638-.479a.5.5 0 0 0-.18-.085l-1.425-.356a1 1 0 0 1-.757-.97V10.5A.5.5 0 0 1 9 10c.516 0 1.706-.52 2.57-2.864.413-1.12.74-2.64.87-4.667q.045-.694.056-1.469z"/>
                            </svg>
                            100-Paws-t
                        </div>
                        <div class="badge badge-warning badge-outline flex flex-row">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4" viewBox="0 0 16 16">
                                <path d="M2 1.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1-.5-.5m2.5.5v1a3.5 3.5 0 0 0 1.989 3.158c.533.256 1.011.791 1.011 1.491v.702c0 .7-.478 1.235-1.011 1.491A3.5 3.5 0 0 0 4.5 13v1h7v-1a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351v-.702c0-.7.478-1.235 1.011-1.491A3.5 3.5 0 0 0 11.5 3V2z"/>
                            </svg>
                            First Accounts
                        </div>
                        <div class="badge badge-info badge-outline">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4" viewBox="0 0 16 16">
                                <path d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.707L8 2.207 1.354 8.853a.5.5 0 1 1-.708-.707z"/>
                                <path d="m14 9.293-6-6-6 6V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5zm-6-.811c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.691 0-5.018"/>
                            </svg>
                            Foster
                        </div>
                        <div class="badge badge-accent badge-outline">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4" viewBox="0 0 16 16">
                                <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6m5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1z"/>
                            </svg>
                            Applied
                        </div>
                        <div class="badge badge-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4" viewBox="0 0 16 16">
                                <path d="M2 1.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1-.5-.5m2.5.5v1a3.5 3.5 0 0 0 1.989 3.158c.533.256 1.011.791 1.011 1.491v.702c0 .7-.478 1.235-1.011 1.491A3.5 3.5 0 0 0 4.5 13v1h7v-1a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351v-.702c0-.7.478-1.235 1.011-1.491A3.5 3.5 0 0 0 11.5 3V2z"/>
                            </svg>
                            Furr-Parent
                        </div>
                    </ul>
                </div>
            </div>
        @endfor
        
        <button class="loadMore m-auto p-1 bg-base-200 mb-2">
            Load More
        </button>
    </div>

    <!-- Services -->
    <div class="flex flex-col m-2 p-2 border-b-2 border-base-300">
        <div class="flex gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-12 h-12" viewBox="0 0 16 16">
                <path d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.707L8 2.207 1.354 8.853a.5.5 0 1 1-.708-.707z"/>
                <path d="m14 9.293-6-6-6 6V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5zm-6-.811c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.691 0-5.018"/>
            </svg>
            <h2 class="text-5xl font-bold">Services</h2>
        </div>
        <p class="text-lg mb-2">Explore a variety of pet services tailored to your needs, including grooming, veterinary care, boarding, and training.</p>

        <div class="carousel w-full mb-2">
            @for ($i = 1; $i <= 3; $i++)
                <div id="slide{{ $i }}" class="carousel-item relative w-full flex justify-center">
                    <div class="card bg-base-200 w-96 shadow-sm border-2 border-base-300">
                        <figure>
                            <img src="https://th.bing.com/th/id/OIP.PXS4cGMqIeBeuiCVKKEjvAHaE8?rs=1&pid=ImgDetMain" alt="Service Image"/>
                        </figure>
                        <div class="card-body">
                            <h2 class="card-title">Service #{{ $i }}</h2>
                            <p>High-quality pet services to keep your furry friend happy and healthy.</p>
                            <div class="card-actions justify-end">
                                <button class="btn btn-primary">Visit Profile</button>
                            </div>
                        </div>
                    </div>
                    <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                        <a href="#slide{{ $i == 1 ? 3 : $i - 1 }}" class="btn btn-circle">❮</a>
                        <a href="#slide{{ $i == 3 ? 1 : $i + 1 }}" class="btn btn-circle">❯</a>
                    </div>
                </div>
            @endfor
        </div>

        <button class="loadMore m-auto p-2 bg-base-200 mb-2 w-64 text-center">
            Load More
        </button>
    </div>

    <!-- Posts -->
    <div class="flex flex-col m-2 p-2 border-b-2 border-base-300">
        <div class="flex gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-12 h-12" viewBox="0 0 16 16">
                <path d="M11 8h2V6h-2z"/>
                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm8.5.5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0zM2 5.5a.5.5 0 0 0 .5.5H6a.5.5 0 0 0 0-1H2.5a.5.5 0 0 0-.5.5M2.5 7a.5.5 0 0 0 0 1H6a.5.5 0 0 0 0-1zM2 9.5a.5.5 0 0 0 .5.5H6a.5.5 0 0 0 0-1H2.5a.5.5 0 0 0-.5.5m8-4v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5"/>
            </svg>
            <h2 class="text-5xl font-bold">Posts</h2>
        </div>
        <p class="text-lg mb-2">Discover community posts, adoption updates, and pet care discussions.</p>
        @for ($i = 0; $i < 3; $i++)
            <div class="card bg-base-200 w-full shadow-xl my-4 border border-base-300">
                <!-- Header with Title and Menu -->
                <div class="flex justify-end items-end p-4">
                <!-- Dropdown Menu -->
                <div class="dropdown dropdown-end z-50">
                    <label tabindex="0" class="btn btn-sm btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                        <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
                    </svg>
                    </label>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-300 rounded-box w-40">
                    <li><a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                        </svg>
                        Edit Post
                    </a></li>
                    <li><a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                        </svg>
                        Delete Post
                    </a></li>
                    <li><a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-flag" viewBox="0 0 16 16">
                        <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21 21 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21 21 0 0 0 14 7.655V1.222z"/>
                        </svg>  
                        Report Post
                    </a></li>
                    </ul>
                </div>
                </div>
            
                <!-- Thumbnail -->
                <div class="px-4 hover:cursor-pointer">
                <img src="https://picsum.photos/1920/1080" alt="Thumbnail" class="w-full max-h-[400px] rounded object-cover" />
                </div>
                <!-- Modal Thumbnail -->
                <dialog id="thumbnailModal" class="modal">
                <div class="modal-box w-[90vw] h-[90vh] max-w-7xl max-h-screen">
                    <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                    </form>
                    <div class="flex justify-center items-center h-full">
                    <img src="https://picsum.photos/1920/1080" alt="Thumbnail" class="max-w-full max-h-full rounded object-cover" />
                    </div>
                </div>
                </dialog>
            
            
                <!-- Card Body -->
                <div class="card-body">
                <div class="flex items-center space-x-3">
                    <div class="avatar">
                        <div class="w-12 h-12 rounded-full">
                            <img src="https://picsum.photos/200" alt="User Avatar">
                        </div>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">John Sigma male</p>
                        <div class="text-xs">
                            <span>Posted on: December 4, 2024</span>
                            <span class="mx-1">|</span>
                            <span>Edited on: December 5, 2024</span>
                        </div>
                    </div>
                </div>
                <div class="text-base mt-2 relative">
                    <!-- Truncated Content -->
                    <p id="description" class="line-clamp-3 text-base transition-all duration-300">
                    Anyone Interested in Adopting My 100-Year-Old Magical Dog?<br><br>
                    
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
                    <button class="btn bg-primary btn-sm text-base-300">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <p>4.5k</p>
                    Likes
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
        @endfor

        <button class="loadMore m-auto p-1 bg-base-200 mb-2">
            Load More
        </button>
    </div>

    <!-- Anouncements -->
    <div class="flex flex-col m-2 p-2 border-b-2 border-base-300">
        <div class="flex gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-12 h-12" viewBox="0 0 16 16">
                <path d="M13 2.5a1.5 1.5 0 0 1 3 0v11a1.5 1.5 0 0 1-3 0zm-1 .724c-2.067.95-4.539 1.481-7 1.656v6.237a25 25 0 0 1 1.088.085c2.053.204 4.038.668 5.912 1.56zm-8 7.841V4.934c-.68.027-1.399.043-2.008.053A2.02 2.02 0 0 0 0 7v2c0 1.106.896 1.996 1.994 2.009l.496.008a64 64 0 0 1 1.51.048m1.39 1.081q.428.032.85.078l.253 1.69a1 1 0 0 1-.983 1.187h-.548a1 1 0 0 1-.916-.599l-1.314-2.48a66 66 0 0 1 1.692.064q.491.026.966.06"/>
            </svg>
            <h2 class="text-5xl font-bold">Announcements</h2>
        </div>
        <p class="text-lg mb-2">Browse announcements to stay informed about the latest updates and news.</p>
        @for ($i = 0; $i < 3; $i++)
            <div class="card bg-base-200 w-full shadow-xl my-4 border border-base-300">
                <!-- Header with Title and Menu -->
                <div class="flex justify-end items-end p-4">
                <!-- Dropdown Menu -->
                <div class="dropdown dropdown-end z-50">
                    <label tabindex="0" class="btn btn-sm btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                        <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
                    </svg>
                    </label>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-300 rounded-box w-[230px]">
                    <li><a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                        </svg>
                        Edit Announcement
                    </a></li>
                    <li><a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                        </svg>
                        Delete Announcement
                    </a></li>
                    <li><a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-flag" viewBox="0 0 16 16">
                        <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21 21 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21 21 0 0 0 14 7.655V1.222z"/>
                        </svg>  
                        Report Announcement
                    </a></li>
                    </ul>
                </div>
                </div>
            
                <!-- Card Body -->
                <div class="card-body mt-0">
                    <div class="text-base mt-2 relative">
                    <h2 class="card-title mb-2 text-3xl">This is a sample Announcement Title!</h2>
                    <p>
                        Imagine coming home from work to find something extraordinary—a glowing puppy! 
                        Yes, you read that right, glowing. I have no idea why or how this happened, but here we are. 
                        I can’t just abandon it, that’s not an option. It’s an incredibly sweet and friendly little thing, 
                        and now it needs a home. If you're looking for a magical (and very unique) companion, 
                        this glowing pup might just be the one for you. Any takers?
                    </p>
                    </div>
                    <div class="flex items-center space-x-3 mt-2">
                        <div class="avatar">
                            <div class="w-12 h-12 rounded-full">
                                <img src="https://picsum.photos/200" alt="User Avatar">
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-semibold">John Sigma male</p>
                            <div class="text-xs">
                                <span>Posted on: December 4, 2024</span>
                                <span class="mx-1">|</span>
                                <span>Edited on: December 5, 2024</span>
                            </div>
                        </div>
                    </div>       
                </div>
            
                <!-- Thumbnail -->
                <div class="m-4 carousel rounded-lg max-h-[200px] overflow-hidden">
                    <div id="slide1" class="carousel-item relative w-full">
                        <img
                            src="https://picsum.photos/1920/1080"
                            class="w-full h-full object-cover" />
                        <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                            <a href="#slide4" class="btn btn-circle">❮</a>
                            <a href="#slide2" class="btn btn-circle">❯</a>
                        </div>
                    </div>
                    <div id="slide2" class="carousel-item relative w-full">
                        <img
                            src="https://picsum.photos/1920/1080"
                            class="w-full h-full object-cover" />
                        <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                            <a href="#slide1" class="btn btn-circle">❮</a>
                            <a href="#slide3" class="btn btn-circle">❯</a>
                        </div>
                    </div>
                    <div id="slide3" class="carousel-item relative w-full">
                        <img
                            src="https://picsum.photos/1920/1080"
                            class="w-full h-full object-cover" />
                        <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                            <a href="#slide2" class="btn btn-circle">❮</a>
                            <a href="#slide4" class="btn btn-circle">❯</a>
                        </div>
                    </div>
                    <div id="slide4" class="carousel-item relative w-full">
                        <img
                            src="https://picsum.photos/1920/1080"
                            class="w-full h-full object-cover" />
                        <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                            <a href="#slide3" class="btn btn-circle">❮</a>
                            <a href="#slide1" class="btn btn-circle">❯</a>
                        </div>
                    </div>
                </div>
            
                <div class="card-body">
                    <!-- Buttons -->
                    <div class="flex gap-2 flex-wrap">
                        <!-- Upvote Button -->
                        <button class="btn bg-primary btn-sm text-base-300">
                            <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            <p>4.5k</p>
                            Likes
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
        @endfor

        <button class="loadMore m-auto p-1 bg-base-200 mb-2">
            Load More
        </button>
    </div>

    <!-- Events -->
    <div class="flex flex-col m-2 p-2 border-b-2 border-base-300">
        <div class="flex gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-12 h-12" viewBox="0 0 16 16">
                <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2M9.5 7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m3 0h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5M2 10.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5"/>
            </svg>
            <h2 class="text-5xl font-bold">Events</h2>
        </div>
        <p class="text-lg mb-2">Discover upcoming gatherings, special events, and opportunities to connect with fellow pet lovers.</p>
        @for ($i = 0; $i < 3; $i++)
            <div class="card bg-base-200 w-full shadow-xl my-4 border border-base-300">
                <!-- Header with Title and Menu -->
                <div class="flex flex-row items-end p-4 justify-between align-middle">
                    <!-- Dropdown Menu -->
                    <div class="flex justify-end w-full">
                        <div class="dropdown dropdown-end z-50">
                            <label tabindex="0" class="btn btn-sm btn-ghost">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
                                </svg>
                            </label>
                            <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-300 rounded-box w-40">
                                <li><a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                </svg>
                                Edit Event
                                </a></li>
                                <li><a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                </svg>
                                Delete Event
                                </a></li>
                                <li><a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-flag" viewBox="0 0 16 16">
                                    <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21 21 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21 21 0 0 0 14 7.655V1.222z"/>
                                </svg>  
                                Report Event
                                </a></li>
                            </ul>
                        </div>
                    </div>
                </div> 
            
                <!-- Thumbnail -->
                <div class="m-4 carousel rounded-lg">
                    <div id="slide1" class="carousel-item relative w-full">
                    <img
                        src="https://picsum.photos/1920/1080"
                        class="w-full" />
                    <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                        <a href="#slide4" class="btn btn-circle">❮</a>
                        <a href="#slide2" class="btn btn-circle">❯</a>
                    </div>
                    </div>
                    <div id="slide2" class="carousel-item relative w-full">
                    <img
                        src="https://picsum.photos/1920/1080"
                        class="w-full" />
                    <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                        <a href="#slide1" class="btn btn-circle">❮</a>
                        <a href="#slide3" class="btn btn-circle">❯</a>
                    </div>
                    </div>
                    <div id="slide3" class="carousel-item relative w-full">
                    <img
                        src="https://picsum.photos/1920/1080"
                        class="w-full" />
                    <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                        <a href="#slide2" class="btn btn-circle">❮</a>
                        <a href="#slide4" class="btn btn-circle">❯</a>
                    </div>
                    </div>
                    <div id="slide4" class="carousel-item relative w-full">
                    <img
                        src="https://picsum.photos/1920/1080"
                        class="w-full" />
                    <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                        <a href="#slide3" class="btn btn-circle">❮</a>
                        <a href="#slide1" class="btn btn-circle">❯</a>
                    </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="text-base mt-2 relative">
                    <h2 class="card-title mb-2 text-3xl">This is a sample Event Title!</h2>
                        <!-- Date -->
                        <div class="text-xs w-full mb-4">
                            <span>From: December 4, 2024</span>
                            <span class="mx-1">|</span>
                            <span>To: December 5, 2024</span>
                        </div>
                    <p>
                        Imagine coming home from work to find something extraordinary—a glowing puppy! 
                        Yes, you read that right, glowing. I have no idea why or how this happened, but here we are. 
                        I can’t just abandon it, that’s not an option. It’s an incredibly sweet and friendly little thing, 
                        and now it needs a home. If you're looking for a magical (and very unique) companion, 
                        this glowing pup might just be the one for you. Any takers?
                    </p>
                    </div>
                    <div class="flex items-center space-x-3 mt-2">
                        <div class="avatar">
                            <div class="w-12 h-12 rounded-full">
                                <img src="https://picsum.photos/200" alt="User Avatar">
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-semibold">John Sigma male</p>
                            <div class="text-xs">
                                <span>Posted on: December 4, 2024</span>
                                <span class="mx-1">|</span>
                                <span>Edited on: December 5, 2024</span>
                            </div>
                        </div>
                    </div>   
                    <!-- Buttons -->
                    <div class="flex gap-2 flex-wrap">
                        <!-- Upvote Button -->
                        <button class="btn bg-primary btn-sm text-base-300">
                            <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            <p>4.5k</p>
                            Likes
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
        @endfor

        <button class="loadMore m-auto p-1 bg-base-200 mb-2">
            Load More
        </button>
    </div>

</div>
<style scoped>
    .loadMore {
    width: 165px;
    height: 62px;
    cursor: pointer;
    color: #fff;
    font-size: 17px;
    border-radius: 1rem;
    border: none;
    position: relative;
    transition: 0.1s;
    }

    .loadMore::after {
    content: '';
    width: 100%;
    height: 100%;
    background-image: radial-gradient( circle farthest-corner at 10% 20%,  rgba(255,94,247,1) 17.8%, rgba(2,245,255,1) 100.2% );
    filter: blur(15px);
    z-index: -1;
    position: absolute;
    left: 0;
    top: 0;
    }

    .loadMore:active {
    transform: scale(0.9) rotate(3deg);
    background: radial-gradient( circle farthest-corner at 10% 20%,  rgba(255,94,247,1) 17.8%, rgba(2,245,255,1) 100.2% );
    transition: 0.5s;
    }
</style>