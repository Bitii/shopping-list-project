<script setup>
import { ref } from "vue";
import axios from "axios";
import { useUserStore } from "../../stores/user";
import { useRouter } from "vue-router";



// A DOM elem referencia létrehozása
const container = ref(null);
const router = useRouter();

const username = ref("");
const password = ref("");
const regusername = ref("");
const email = ref("");
const regpassword = ref("");
const error = ref("");

const userData = useUserStore();

// A funkciók az osztályok hozzáadására és eltávolítására
const switchToSignUp = () => {
  if (container.value) {
    container.value.classList.add("sign-up-mode");
  }
};

const switchToSignIn = () => {
  if (container.value) {
    container.value.classList.remove("sign-up-mode");
  }
};
const login = async () => {
  if (!username.value || !password.value) {
    error.value = "Kérem töltse ki a mezőket!";
    return;
  }
  try {
    let resp = await axios.post("http://localhost:8000/api/users/login", {
      username: username.value,
      password: password.value,
    });
    userData.setUser(resp.data.user);
    router.push("/list");
  } catch (err) { // Helyes hibakezelés
    error.value = "Hibás felhasználó vagy jelszó!";
    console.log(err);
  }
};

const register = async () =>
{
  if (!regusername.value || !email.value || !regpassword.value) {
    error.value = "Kérem töltse ki a mezőket!";
    return;
  }
  try
  {
    let resp = await axios.post("http://localhost:8000/api/users/register", {
      username: regusername.value,
      email: email.value,
      password: regpassword.value,
    });
    userData.setUser(resp.data.user);
    alert("Sikeres regisztráció!");
    location.reload();   
  } catch (error) {
    error.value = "Sikertelen regisztráció!";
    console.log(error);
    
  }
}


</script>

<template>
  <div ref="container" class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <!-- LOGIN -->

        <form class="sign-in-form">
          <h2 class="title">Login</h2>
          
          <div v-if="error" class="warning-message">{{ error }}</div>
          <div class="input-field">
            <i><font-awesome-icon icon="fa-solid fa-user" /></i>
            <input
              type="text"
              placeholder="Username"
              required
              v-model="username"
            />
          </div>
          <div class="input-field">
            <i><font-awesome-icon icon="fa-solid fa-lock" /></i>
            <input
              type="password"
              placeholder="Password"
              required
              v-model="password"
            />
          </div>
          <input @click.prevent="login" type="submit" value="Login" class="btn solid"
          />
        </form>

        <!-- REGISTER -->
        <form id="signup" class="sign-up-form">
          <h2 class="title">Sign up</h2>
          {{ error }}
          <div class="input-field">
            <i><font-awesome-icon icon="fa-solid fa-user" /></i>
            <input
              type="text"
              placeholder="Username"
              required
              v-model="regusername"
            />
          </div>
          <div class="input-field">
            <i><font-awesome-icon icon="fa-solid fa-envelope" /></i>
            <input type="email" placeholder="Email" required v-model="email" />
          </div>
          <div class="input-field">
            <i><font-awesome-icon icon="fa-solid fa-lock" /></i>
            <input
              type="password"
              placeholder="Password"
              required
              v-model="regpassword"
            />
          </div>
          <input @click.prevent="register" type="submit" class="btn" value="Sign up" />
        </form>
      </div>
    </div>
    <!-- Panels and buttons -->
    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>Not yet registered ?</h3>
          <p>
            Create an account and start your own shopping list.
          </p>
          <button
            class="btn transparent"
            id="sign-up-btn"
            @click="switchToSignUp"
          >
            Sign up
          </button>
        </div>
        <img src="../../public/login.svg" class="image" alt="login image" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>Are you registered already?</h3>
          <p>Let's login and start writing your shopping list.</p>
          <button
            class="btn transparent"
            id="sign-in-btn"
            @click="switchToSignIn"
          >
            Login
          </button>
        </div>
        <img
          src="../../public/register.svg"
          class="image"
          alt="register image"
        />
      </div>
    </div>
  </div>
</template>

<style scoped>
template,
input {
  font-family: "Poppins", sans-serif;
}

.container {
  position: relative;
  width: 100%;
  background-color: #fff;
  min-height: 100vh;
  overflow: hidden;
}

.forms-container {
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
}

.signin-signup {
  position: absolute;
  top: 50%;
  transform: translate(-50%, -50%);
  left: 75%;
  width: 50%;
  transition: 1s 0.7s ease-in-out;
  display: grid;
  grid-template-columns: 1fr;
  z-index: 5;
}

form {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  padding: 0rem 5rem;
  transition: all 0.2s 0.7s;
  overflow: hidden;
  grid-column: 1 / 2;
  grid-row: 1 / 2;
}

form.sign-up-form {
  opacity: 0;
  z-index: 1;
}

form.sign-in-form {
  z-index: 2;
}

.title {
  font-size: 2.2rem;
  color: #444;
  margin-bottom: 10px;
}

.input-field {
  max-width: 380px;
  width: 100%;
  background-color: #f0f0f0;
  margin: 10px 0;
  height: 55px;
  border-radius: 55px;
  display: grid;
  grid-template-columns: 15% 85%;
  padding: 0 0.4rem;
  position: relative;
}

.input-field i {
  text-align: center;
  line-height: 55px;
  color: #acacac;
  transition: 0.5s;
  font-size: 1.1rem;
}

.input-field input {
  background: none;
  outline: none;
  border: none;
  line-height: 1;
  font-weight: 600;
  font-size: 1.1rem;
  color: #333;
}

.input-field input::placeholder {
  color: #aaa;
  font-weight: 500;
}

.btn {
  width: 150px;
  background-color: #5995fd;
  border: none;
  outline: none;
  height: 49px;
  border-radius: 49px;
  color: #fff;
  text-transform: uppercase;
  font-weight: 600;
  margin: 10px 0;
  cursor: pointer;
  transition: 0.5s;
}

.btn:hover {
  background-color: #4d84e2;
}

.panels-container {
  position: absolute;
  height: 100%;
  width: 100%;
  top: 0;
  left: 0;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
}

.container:before {
  content: "";
  position: absolute;
  height: 2000px;
  width: 2000px;
  top: -10%;
  right: 48%;
  transform: translateY(-50%);
  background-image: linear-gradient(-45deg, #4481eb 0%, #04befe 100%);
  transition: 1.8s ease-in-out;
  border-radius: 50%;
  z-index: 6;
}

.image {
  width: 100%;
  transition: transform 1.1s ease-in-out;
  transition-delay: 0.4s;
}

.panel {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  justify-content: space-around;
  text-align: center;
  z-index: 6;
}

.left-panel {
  pointer-events: all;
  padding: 3rem 17% 2rem 12%;
}

.right-panel {
  pointer-events: none;
  padding: 3rem 12% 2rem 17%;
}

.panel .content {
  color: #fff;
  transition: transform 0.9s ease-in-out;
  transition-delay: 0.6s;
}

.panel h3 {
  font-weight: 600;
  line-height: 1;
  font-size: 1.5rem;
}

.panel p {
  font-size: 0.95rem;
  padding: 0.7rem 0;
}

.btn.transparent {
  margin: 0;
  background: none;
  border: 2px solid #fff;
  width: 130px;
  height: 41px;
  font-weight: 600;
  font-size: 0.8rem;
}

.right-panel .image,
.right-panel .content {
  transform: translateX(800px);
}
.warning-message {
  color: red;
  font-weight: bold;
  margin-bottom: 10px;
}

/* ANIMATION */

.container.sign-up-mode:before {
  transform: translate(100%, -50%);
  right: 52%;
}

.container.sign-up-mode .left-panel .image,
.container.sign-up-mode .left-panel .content {
  transform: translateX(-800px);
}

.container.sign-up-mode .signin-signup {
  left: 25%;
}

.container.sign-up-mode form.sign-up-form {
  opacity: 1;
  z-index: 2;
}

.container.sign-up-mode form.sign-in-form {
  opacity: 0;
  z-index: 1;
}

.container.sign-up-mode .right-panel .image,
.container.sign-up-mode .right-panel .content {
  transform: translateX(0%);
}

.container.sign-up-mode .left-panel {
  pointer-events: none;
}

.container.sign-up-mode .right-panel {
  pointer-events: all;
}

/* RESPONSIVE*/

@media (max-width: 870px) {
  .container {
    min-height: 800px;
    height: 100vh;
  }

  .signin-signup {
    width: 100%;
    top: 95%;
    transform: translate(-50%, -100%);
    transition: 1s 0.8s ease-in-out;
  }

  .signin-signup,
  .container.sign-up-mode .signin-signup {
    left: 50%;
  }

  .panels-container {
    grid-template-columns: 1fr;
    grid-template-rows: 1fr 2fr 1fr;
  }

  .panel {
    flex-direction: row;
    justify-content: space-around;
    align-items: center;
    padding: 2.5rem 8%;
    grid-column: 1 / 2;
  }

  .right-panel {
    grid-row: 3 / 4;
  }

  .left-panel {
    grid-row: 1 / 2;
  }

  .image {
    width: 200px;
    transition: transform 0.9s ease-in-out;
    transition-delay: 0.6s;
  }

  .panel .content {
    padding-right: 15%;
    transition: transform 0.9s ease-in-out;
    transition-delay: 0.8s;
  }

  .panel h3 {
    font-size: 1.2rem;
  }

  .panel p {
    font-size: 0.7rem;
    padding: 0.5rem 0;
  }

  .btn.transparent {
    width: 110px;
    height: 35px;
    font-size: 0.7rem;
  }

  .container:before {
    width: 1500px;
    height: 1500px;
    transform: translateX(-50%);
    left: 30%;
    bottom: 68%;
    right: initial;
    top: initial;
    transition: 2s ease-in-out;
  }

  .container.sign-up-mode:before {
    transform: translate(-50%, 100%);
    bottom: 32%;
    right: initial;
  }

  .container.sign-up-mode .left-panel .image,
  .container.sign-up-mode .left-panel .content {
    transform: translateY(-300px);
  }

  .container.sign-up-mode .right-panel .image,
  .container.sign-up-mode .right-panel .content {
    transform: translateY(0px);
  }

  .right-panel .image,
  .right-panel .content {
    transform: translateY(300px);
  }

  .container.sign-up-mode .signin-signup {
    top: 5%;
    transform: translate(-50%, 0);
  }
}

@media (max-width: 570px) {
  form {
    padding: 0 1.5rem;
  }

  .image {
    display: none;
  }

  .panel .content {
    padding: 0.5rem 1rem;
  }

  .container {
    padding: 1.5rem;
  }

  .container:before {
    bottom: 72%;
    left: 50%;
  }

  .container.sign-up-mode:before {
    bottom: 28%;
    left: 50%;
  }
}
</style>
