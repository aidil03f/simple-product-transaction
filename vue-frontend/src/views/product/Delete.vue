<template>
  <button ref="deleteProduct" @click="destroyProduct">Delete</button>
</template>

<script>
import axios from "axios";
export default {
  props: ["endpoint"],

  methods: {
    async destroyProduct() {
      if (window.confirm("are you sure ?")) {
        let response = await axios.delete(
          `http://127.0.0.1:8000/api/v1/products/${this.endpoint}`
        );
        if (response.status == 200) {
          this.$refs.deleteProduct.parentNode.parentNode.remove();
        }
      }
    },
  },
};
</script>
