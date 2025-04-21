// resources/js/router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import PostDetail from '../components/partials/posts/PostDetail.vue';

const routes = [
  {
    path: '/post/detail/:id',
    name: 'PostDetail',
    component: PostDetail,
    props: true,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;