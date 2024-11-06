import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import { createPinia } from "pinia";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { library } from "@fortawesome/fontawesome-svg-core";

import { faUser } from "@fortawesome/free-solid-svg-icons";
import { faEnvelope } from "@fortawesome/free-solid-svg-icons";
import { faLock } from "@fortawesome/free-solid-svg-icons";

library.add(faUser, faEnvelope, faLock);

const pinia = createPinia();

createApp(App)
  .use(pinia)
  .use(router)
  .component("font-awesome-icon", FontAwesomeIcon)
  .mount("#app");
