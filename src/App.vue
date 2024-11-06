<!-- MINDENRE ÉRVÉNYES SCRIPT -->
<script setup>
import Welcome from "./components/Welcome.vue";
import Home from "./components/Home.vue";
import { useUserStore } from "../stores/user";
import { RouterLink, useRouter } from "vue-router";

const userData = useUserStore();
</script>

<!-- FŐ TEMPLATE -->
<template>
  <router-view />
</template>

<!-- MINDENRE ÉRVÉNYES CSS -->
<style>
@import url("https://fonts.googleapis.com/css2?family=Poppins&display=swap");
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
#app {
  font-family: "Poppins", sans-serif;
  color: #333;
}
</style>
