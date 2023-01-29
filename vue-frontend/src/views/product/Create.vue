<template>
  <div>
    <Navigation2 />
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-5 mt-5">
          <div class="card">
            <div class="card-header">
              create product
            </div>
            <div class="card-body">
              <form method="post" @submit.prevent="create" autocomplete="off">
                <div class="form-group">
                  <label>Product Name *</label>
                  <input
                    type="text"
                    v-model="form.name"
                    class="form-control"
                    placeholder="Product Name"
                  />
                  <div v-if="theErrors.name" class="text-danger mt-2">
                    {{ theErrors.name[0] }}
                  </div>
                </div>
                <div class="form-group">
                  <label>Price *</label>
                  <input
                    type="number"
                    v-model="form.price"
                    class="form-control"
                    placeholder="Price"
                  />
                  <div v-if="theErrors.price" class="text-danger mt-2">
                    {{ theErrors.price[0] }}
                  </div>
                </div>
                <div class="form-group">
                  <label>Stock *</label>
                  <input
                    type="text"
                    v-model="form.stock"
                    class="form-control"
                    placeholder="Stock"
                  />
                  <div v-if="theErrors.stock" class="text-danger mt-2">
                    {{ theErrors.stock[0] }}
                  </div>
                </div>
                <div class="form-group">
                  <label>Description *</label>
                  <textarea
                    name="description"
                    v-model="form.description"
                    class="form-control"
                    placeholder="Description"
                  ></textarea>
                  <div v-if="theErrors.description" class="text-danger mt-2">
                    {{ theErrors.description[0] }}
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="submit" class="btn btn-outline-info">
                    Save
                  </button>
                  <router-link
                    :to="{ name: 'product.index' }"
                    class="btn btn-outline-warning"
                    >Back</router-link
                  >
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
input[type="text"]::placeholder {
  font-size: 14px;
  font-family: "Courier New", Courier, monospace;
}
</style>

<script>
import axios from "axios";
import Navigation2 from "../../components/Navigation2";
export default {
  components: {
    Navigation2,
  },
  data() {
    return {
      form: {
        name: "",
        price: "",
        stock: "",
        description: "",
      },
      theErrors: [],
    };
  },

  methods: {
    async create() {
      try {
        let response = await axios.post(
          "http://127.0.0.1:8000/api/v1/products",
          this.form
        );
        if (response.status == 200) {
          this.$router.push("/products");
        }
      } catch (e) {
        this.theErrors = e.response.data.errors;
      }
    },
  },
};
</script>
