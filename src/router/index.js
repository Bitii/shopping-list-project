import { createRouter, createWebHistory } from "vue-router";
import List from "../components/List.vue";
import Welcome from "../components/Welcome.vue";
import { useUserStore } from "../../stores/user";
import Guide from "../components/Guide.vue";

const routes = [
    { path: "/", component: Welcome },
    { path: "/list", component: List },
    { path: "/guide", component: Guide}
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
  const userStore = useUserStore();
  if (to.path === "/list" && !userStore.user) {
    next("/");
  } else {
    next();
  }
});

export default router;