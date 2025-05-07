// resources/js/router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import Messages from '../components/Auth/Messages.vue';
import UserProfile from '../components/Auth/UserProfile.vue';
import ContentDetail from '../components/Notifications/partials/ContentDetail.vue';

const routes = [
  {
    path: '/profile',
    name: 'UserProfile',
    component: UserProfile
  },
  {
    path: '/content/detail/:notificationId',
    name: 'ContentDetail',
    component: ContentDetail,
    props: true,
  },
  {
    path: '/messages',
    name: 'Messages',
    component: Messages,
  },
  {
    path: '/messages/:id',
    name: 'Conversation',
    component: Messages,
    props: true,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;