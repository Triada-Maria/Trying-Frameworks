//router.js
import { createRouter, createWebHistory } from "vue-router";
import Home from './pages/Home.vue';
import Events from './pages/Events.vue';

const routes =
[
    { path: '/', redirect: '/home' }, // default route
    { path: '/home', name: 'home', component: Home },
    { path: '/events', name: 'events', component: Events },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;