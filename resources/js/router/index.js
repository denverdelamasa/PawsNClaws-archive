// resources/js/router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import PostDetail from '../components/partials/posts/PostDetail.vue';
import Messages from '../components/Auth/Messages.vue';

const routes = [
  {
    path: '/post/detail/:id',
    name: 'PostDetail',
    component: PostDetail,
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