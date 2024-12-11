import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Import Vue and the component
import { createApp } from 'vue';
import Notification from './components/Notifications/Notifications.vue';
import UploadPost from './components/partials/misc/UploadPost.vue';
import PostCard from './components/partials/posts/PostCard.vue';
import Browse from './components/partials/browse/Browse.vue';
import SignUp from './components/Auth/SignUp.vue';
import Dashboard from './components/Admin/Dashboard.vue';
import AccountsManagement from './components/Admin/AccountsManagement.vue';
import ReportsManagement from './components/Admin/ReportsManagement.vue';

// Create the Vue app
const app1 = createApp({});
app1.component('notifications', Notification);
app1.mount('#app');
// Create the event bus and attach it globally to the window
const eventBus = createApp({});
window.eventBus = eventBus;

const app2 = createApp({});
app2.component('upload-post', UploadPost);
app2.component('post-card', PostCard);
app2.component('browse', Browse);
app2.component('sign-up', SignUp);
app2.component('dashboard', Dashboard);
app2.component('accounts-management', AccountsManagement);
app2.component('reports-management', ReportsManagement);

app2.mount("#app2");