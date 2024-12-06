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

// Create the Vue app
const app = createApp({});

// Register components
app.component('notifications', Notification);

// Mount the Vue app to the #app element
app.mount('#app');
