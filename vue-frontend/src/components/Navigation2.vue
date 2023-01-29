<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="navbar-brand">App</div>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <router-link to="/products" class="nav-link">Products</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/transactions" class="nav-link"
              >Transaction</router-link
            >
          </li>
        </ul>
        <div class="form-inline my-lg-0">
          <!-- <div class="my-sm-2 text-white mr-2">Username</div> -->
          <form @submit.prevent="Logout">
            <button type="submit" class="btn btn-primary text-white my-sm-0">
              Logout
            </button>
          </form>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {};
  },

  methods: {
    async Logout() {
      let response = await axios.post("http://127.0.0.1:8000/api/v1/logout");
      if (response.status == 200) {
        localStorage.removeItem("token");
        this.$router.push("/login");
      }
    },
  },

  created() {
    axios.defaults.headers.common["Authorization"] =
      "Bearer " + localStorage.getItem("token");
  },
};
</script>
