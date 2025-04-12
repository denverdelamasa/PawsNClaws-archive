<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="{{ $theme ?? 'light' }}">
    @include('partials.main.scripts-styles', ['theme' => $theme])
    <body class="font-sans">
        <div id="app2">
            <div class="flex flex-col">
                @include('partials.main.navbar')
                <div class="drawer lg:drawer-open">
                    <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
                    <div class="drawer-content flex flex-col items-center justify-start overflow-y-auto">
                        <div class="w-full max-w-full h-full bg-base-100 rounded-xl shadow-xl flex flex-col overflow-y-scroll px-2 py-2">
                            <div class="flex items-center justify-between border-b border-base-300 pb-2 w-full">
                                <div class="flex items-center gap-3">
                                    <div class="avatar">
                                        <div class="w-10 rounded-full">
                                            <img src="https://i.pravatar.cc/300?u=chat1" alt="User Avatar" />
                                        </div>
                                    </div>
                                    <div>
                                        <h2 class="font-bold text-lg">Wane Danvers</h2>
                                        <p class="text-sm text-base-content/50">Online</p>
                                    </div>
                                </div>
                                <button class="btn btn-sm btn-outline btn-primary">Visit Profile</button>
                            </div>
                            <div class="flex-1 overflow-y-auto space-y-4 py-4 px-2 pb-28 hide-scrollbar w-full">
                                <div class="chat chat-start">
                                    <div class="chat-image avatar">
                                        <div class="w-8 rounded-full">
                                            <img src="https://i.pravatar.cc/300?u=chat1" />
                                        </div>
                                    </div>
                                    <div class="chat-header">
                                        Juan
                                        <time class="text-xs opacity-50 ml-1">12:00 PM</time>
                                    </div>
                                    <div class="chat-bubble">Hey! Are you still fostering that puppy?</div>
                                </div>
                                <div class="chat chat-end">
                                    <div class="chat-image avatar">
                                        <div class="w-8 rounded-full">
                                            <img src="https://i.pravatar.cc/300?u=chat2" />
                                        </div>
                                    </div>
                                    <div class="chat-header">
                                        You
                                        <time class="text-xs opacity-50 ml-1">12:01 PM</time>
                                    </div>
                                    <div class="chat-bubble chat-bubble-primary">Yup! He's still available 😊</div>
                                </div>
                                <div class="chat chat-start">
                                    <div class="chat-image avatar">
                                        <div class="w-8 rounded-full">
                                            <img src="https://i.pravatar.cc/300?u=chat1" />
                                        </div>
                                    </div>
                                    <div class="chat-header">
                                        Juan
                                        <time class="text-xs opacity-50 ml-1">12:03 PM</time>
                                    </div>
                                    <div class="chat-bubble">Okay, let's meet up</div>
                                </div>
                                <div class="chat chat-end">
                                    <div class="chat-image avatar">
                                        <div class="w-8 rounded-full">
                                            <img src="https://i.pravatar.cc/300?u=chat2" />
                                        </div>
                                    </div>
                                    <div class="chat-header">
                                        You
                                        <time class="text-xs opacity-50 ml-1">12:03 PM</time>
                                    </div>
                                    <div class="chat-bubble chat-bubble-primary">Okay 😊</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 border-t border-base-300 pt-3 w-full sticky bottom-0 bg-base-100 z-10 px-2">
                                <input type="text" placeholder="Type your message..." class="input input-bordered w-full" />
                                <button class="btn btn-primary">Send</button>
                            </div> 
                        </div>                
                    </div>





                    <!-- DONE NATO PLS WAG MONA GALAWIN DENVER TT_T_T_T_ -->
                    <div class="drawer-side">
                        <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
                        <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4 gap-y-2">
                            <strong class="text-3xl">CHATS</strong>
                            <input
                            type="text"
                            placeholder="Search People..."
                            class="input input-bordered border-base-300 input-accent max-w-xxs h-[40px] bg-base-100 hidden lg:block"/>
                            @for ($i = 0; $i < 16; $i++)
                                <li class="p-2 border-b-2 border-base-300"><a>
                                    <figure class="m-auto w-8 h-8 rounded-full overflow-hidden">
                                        <img
                                            src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.webp"
                                            alt="User Avatar"
                                            class="w-full h-full object-cover" />
                                    </figure>
                                    <div class="flex flex-col">
                                        <strong>Bolengkey</strong>
                                        <p>Hellow! ako po ay isang... </p>
                                    </div>
                                </a></li>
                            @endfor
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </body>
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
    <script>
    document.addEventListener('DOMContentLoaded', () => {
    const uploadBox = document.getElementById('uploadBox');

    // Toggle visibility on scroll
    document.addEventListener('scroll', () => {
        if (window.scrollY === 0) {
        uploadBox.classList.add('hidden');
        uploadBox.classList.remove('block');
        } else {
        uploadBox.classList.add('block');
        uploadBox.classList.remove('hidden');
        }
        });
    });
</script>