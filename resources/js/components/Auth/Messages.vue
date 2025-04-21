<template>
<div class="flex flex-col">
    <div class="drawer lg:drawer-open">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col items-center justify-start overflow-y-auto">
            <div class="w-full max-w-full h-full bg-base-100 rounded-xl shadow-xl flex flex-col overflow-y-scroll">
                <div class="flex items-center justify-between border-b border-base-300 w-full px-2 py-2">
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
                <Conversation/>
                <div class="flex items-center gap-3 border-t border-base-300 pt-3 w-full sticky bottom-0 bg-base-100 z-10 px-2 py-2">
                    <input type="text" placeholder="Type your message..." class="input input-bordered w-full" />
                    <button class="btn btn-primary">Send</button>
                </div> 
            </div>                
        </div>
        <div class="drawer-side">
            <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4 gap-y-2">
                <strong class="text-3xl">CHATS</strong>
                <input
                type="text"
                placeholder="Search People..."
                class="input input-bordered border-base-300 input-accent max-w-xxs h-[40px] bg-base-100 hidden lg:block"/>
                
                <UserList/>
            </ul>
        </div>
    </div>
</div>
</template>
<script>
import axios from 'axios';
import UserList from './partials/UserList.vue';
import Conversation from './partials/Conversation.vue';

export default {
    components: {
        UserList,
        Conversation
    }
}
</script>