<template>
  <div>
    <Navigation2 />
    <div class="container mt-5">
      <div class="d-flex justify-content-between">
        <h3>Products</h3>
        <router-link
          :to="{ name: 'product.create' }"
          class="btn btn-primary mb-3"
          title="Create"
          >Create</router-link
        >
      </div>
      <div class="table table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>Price</th>
              <th>Stock</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="product in Products" :key="product.id">
              <td>{{ product.name }}</td>
              <td>{{ product.price }}</td>
              <td>{{ product.stock }}</td>
              <td>{{ product.description }}</td>
              <td class="col-2">
                <router-link
                  :to="{ name: 'product.edit', params: { id: product.id } }"
                  class="btn btn-warning btn-sm"
                  title="Edit"
                  >Edit</router-link
                >
                &nbsp;
                <delete-product
                  :endpoint="product.id"
                  class="btn btn-danger btn-sm"
                  title="Delete"
                />
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import DeleteProduct from "./Delete";
import Navigation2 from "../../components/Navigation2";
export default {
  components: {
    Navigation2,
    DeleteProduct,
  },

  data() {
    return {
      Products: [],
    };
  },

  mounted() {
    this.getProducts();
  },

  methods: {
    async getProducts() {
      let response = await axios.get("http://127.0.0.1:8000/api/v1/products");
      this.Products = response.data.data;
    },
  },
};
</script>
