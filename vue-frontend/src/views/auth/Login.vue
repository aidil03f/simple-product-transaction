<template>
  <div>
    <Navigation />
    <div class="login_form">
      <h4 class="text-center">Login</h4>
      <form @submit.prevent="create" autocomplete="off">
        <div class="form-group">
          <label>Username</label>
          <input
            type="text"
            class="form-control"
            v-model="form.username"
            placeholder="Username"
          />
          <div v-if="theErrors.username" class="text-primary mt-2">
            {{ theErrors.username[0] }}
          </div>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input
            type="password"
            class="form-control"
            v-model="form.password"
            placeholder="*******"
          />
          <div v-if="theErrors.password" class="text-primary mt-2">
            {{ theErrors.password[0] }}
          </div>
        </div>
        <button type="submit" class="btn btn-primary form-control">
          Login
        </button>
      </form>
    </div>
  </div>
</template>

<style>
.login_form {
  width: 350px;
  background: #83aed0;
  margin: 80px auto;
  padding: 30px 20px;
}

label {
  font-size: 11pt;
}

input[type="email"]::placeholder {
  font-size: 14px;
  font-family: "Courier New", Courier, monospace;
}
input[type="password"]::placeholder {
  font-size: 14px;
  font-family: "Courier New", Courier, monospace;
}
</style>

<script>
import axios from "axios";
import Navigation from "../../components/Navigation";
export default {
  components: {
    Navigation,
  },

  data() {
    return {
      form: {
        username: "",
        password: "",
      },
      theErrors: [],
    };
  },

  methods: {
    async create() {
      try {
        let response = await axios.post(
          "http://127.0.0.1:8000/api/login",
          this.form
        );
        if (response.status == 200) {
          localStorage.setItem("token", response.data.token);
          console.log(response.data);
          this.$router.push("/products");
        }
      } catch (e) {
        this.theErrors = e.response.data.errors;
      }
    },
  },
};
</script>
