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
import browse from './components/partials/browse/Browse.vue';
import Browse from './components/partials/browse/Browse.vue';

// Create the Vue app
const app1 = createApp({});

// Register components
app1.component('notifications', Notification);

// Mount the Vue app to the #app element
app1.mount('#app');

const app2 = createApp({});
app2.component('upload-post', UploadPost);
app2.mount("#app2");




// Create the main Vue app instance
const app = createApp({});

app.component('browse', Browse);

app.mount('#browse-app');