<template>
  <button ref="deleteTransaction" @click="destroyTransaction">Delete</button>
</template>

<script>
import axios from "axios";
export default {
  props: ["endpoint"],

  methods: {
    async destroyTransaction() {
      if (window.confirm("are you sure ?")) {
        let response = await axios.delete(
          `http://127.0.0.1:8000/api/v1/transactions/${this.endpoint}`
        );
        if (response.status == 200) {
          this.$refs.deleteTransaction.parentNode.parentNode.remove();
        }
      }
    },
  },
};
</script>
