import { createRouter, createWebHistory } from "vue-router";
import List from "../components/List.vue";
import Welcome from "../components/Welcome.vue";

const routes = [
    { path: "/", component: Welcome },
    { path: "/list", component: List },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;