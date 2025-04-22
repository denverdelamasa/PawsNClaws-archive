// resources/js/router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import PostDetail from '../components/partials/posts/PostDetail.vue';
import Messages from '../components/Auth/Messages.vue';
import UserProfile from '../components/Auth/UserProfile.vue';

const routes = [
  {
    path: '/post/detail/:id',
    name: 'PostDetail',
    component: PostDetail,
    props: true,
  },
  {
    path: '/profile',
    name: 'UserProfile',
    component: UserProfile
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