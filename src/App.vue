<!-- MINDENRE ÉRVÉNYES SCRIPT -->
<script setup>
import Welcome from "./components/Welcome.vue";
import Home from "./components/Home.vue";
import { useUserStore } from "../stores/user";

const userData = useUserStore();
</script>

<!-- FŐ TEMPLATE -->
<template>
  <Welcome v-if="!userData.user.token" /> <!-- Welcome.vue meghívása BE KELL IMPORTÁLNI - ellenőrzi hogy be van-e jelentkezve -->
  <Home v-if="userData.user.token" /> <!-- Home.vue meghívása BE KELL IMPORTÁLNI - ha be van jelentkezve -->
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
