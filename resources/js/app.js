import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const urlParams = new URLSearchParams(window.location.search);
const userIdFromUrl = urlParams.get('user_id') || null;

// Import Vue and the component
import { createApp } from 'vue';
import router from './router';
import Notification from './components/Notifications/Notifications.vue';
import UploadPost from './components/partials/misc/UploadPost.vue';
import PostCard from './components/partials/posts/PostCard.vue';
import Browse from './components/partials/browse/Browse.vue';
import SignUp from './components/Auth/SignUp.vue';
import Dashboard from './components/Admin/Dashboard.vue';
import AccountsManagement from './components/Admin/AccountsManagement.vue';
import ReportsManagement from './components/Admin/ReportsManagement.vue';
import Footer from './components/partials/misc/Footer.vue';
import UserProfile from './components/Auth/UserProfile.vue';
import Announcement from './components/partials/posts/Announcement.vue';
import AnnouncementWelcome from './components/partials/posts/AnnouncementWelcome.vue';
import Event from './components/partials/posts/Event.vue';
import BrowseAccounts from './components/partials/browse/BrowseAccounts.vue';
import ViewAccount from './components/partials/misc/ViewAccount.vue';
import PostDetail from './components/partials/posts/PostDetail.vue';
import CombinedFeed from './components/partials/posts/CombinedFeed.vue';
import Bookmarks from './components/partials/misc/Bookmarks.vue';
import Messages from './components/Auth/Messages.vue';

// Create the Vue app
const app1 = createApp({});
app1.component('notifications', Notification);
app1.use(router);
app1.mount('#app');

// Create the event bus and attach it globally to the window
const eventBus = createApp({});
window.eventBus = eventBus;

const app2 = createApp({
    data() {
        return {
            userId: userIdFromUrl
        };
    }
});
app2.use(router);

app2.component('upload-post', UploadPost);
app2.component('post-card', PostCard);
app2.component('browse', Browse);
app2.component('sign-up', SignUp);
app2.component('dashboard', Dashboard);
app2.component('accounts-management', AccountsManagement);
app2.component('reports-management', ReportsManagement);
app2.component('user-profile', UserProfile);
app2.component('profile-footer', Footer);
app2.component('announcement-cards', Announcement);
app2.component('event-cards', Event);
app2.component('browse-accounts', BrowseAccounts);
app2.component('view-account', ViewAccount);
app2.component('post-detail', PostDetail);
app2.component('combined-feed', CombinedFeed);
app2.component('user-bookmarks', Bookmarks);
app2.component('user-messages', Messages);

app2.mount("#app2");

const app3 = createApp({});

app3.component('announcement-welcome', AnnouncementWelcome);
app3.mount("#app3")