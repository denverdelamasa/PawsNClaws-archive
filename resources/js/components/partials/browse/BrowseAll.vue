<template>
<div class="h-full w-full bg-base-100 overflow-auto gap-4 p-6 flex flex-col">
    <!-- Users -->
    <div class="flex flex-col m-2 p-2 border-b-2 border-base-300">
        <browseAccounts/>
    </div>

    <!-- Services -->
    <div class="flex flex-col m-2 p-2 border-b-2 border-base-300">
        <browseServices/>
    </div>

    <!-- Posts -->
    <div class="flex flex-col m-2 p-2 border-b-2 border-base-300">
        <browsePosts/>
    </div>

    <!-- Anouncements -->
    <div class="flex flex-col m-2 p-2 border-b-2 border-base-300">
        <browseAnnouncements/>
    </div>

    <!-- Events -->
    <div class="flex flex-col m-2 p-2 border-b-2 border-base-300">
        <browseEvents/>
    </div>
</div>
</template>
<script>
import browseAccounts from './BrowseAccounts.vue';
import browsePosts from './BrowsePosts.vue';
import browseServices from './BrowseServices.vue';
import browseAnnouncements from './browseAnnouncements.vue';
import browseEvents from './BrowseEvents.vue';


export default {
    components: {
        browseAccounts,
        browsePosts,
        browseServices,
        browseEvents,
        browseAnnouncements,
    }
}
</script>
<style>
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

/* From Uiverse.io by kirzin */ 
.AccountBrowseViewButton {
    text-decoration: none;
    position: relative;
    border: none;
    font-size: 14px;
    font-family: inherit;
    cursor: pointer;
    color: #fff;
    width: 9em;
    height: 3em;
    line-height: 2em;
    text-align: center;
    background: linear-gradient(90deg, #03a9f4, #f441a5, #ffeb3b, #03a9f4);
    background-size: 300%;
    border-radius: 30px;
    z-index: 1;
}

.AccountBrowseViewButton:hover {
    animation: ani 8s linear infinite;
    border: none;
}

@keyframes ani {
0% {
    background-position: 0%;
}

100% {
    background-position: 400%;
}
}

.AccountBrowseViewButton:before {
    content: "";
    position: absolute;
    top: -5px;
    left: -5px;
    right: -5px;
    bottom: -5px;
    z-index: -1;
    background: linear-gradient(90deg, #03a9f4, #f441a5, #ffeb3b, #03a9f4);
    background-size: 400%;
    border-radius: 35px;
    transition: 1s;
}

.AccountBrowseViewButton:hover::before {
    filter: blur(20px);
}

.AccountBrowseViewButton:active {
    background: linear-gradient(32deg, #03a9f4, #f441a5, #ffeb3b, #03a9f4);
}
</style>