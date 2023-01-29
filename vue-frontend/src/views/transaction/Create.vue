<template>
  <div>
    <Navigation2 />
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-5 mt-5">
          <div class="card">
            <div class="card-header">
              create transaction
            </div>
            <div class="card-body">
              <form method="post" @submit.prevent="create" autocomplete="off">
                <div class="form-group">
                  <label>Product Name *</label>
                  <select
                    class="form-control"
                    name="productId"
                    v-model="form.productId"
                  >
                    <option
                      v-for="product in Products"
                      :key="product.id"
                      :value="product.id"
                    >
                      {{ product.name }}
                    </option>
                  </select>
                  <div v-if="theErrors.productId" class="text-danger mt-2">
                    {{ theErrors.productId[0] }}
                  </div>
                </div>
                <div class="form-group">
                  <label>Reference No *</label>
                  <input
                    type="text"
                    v-model="form.referenceNo"
                    class="form-control"
                    placeholder="Reference"
                  />
                  <div v-if="theErrors.referenceNo" class="text-danger mt-2">
                    {{ theErrors.referenceNo[0] }}
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
                  <label>Quantity *</label>
                  <input
                    type="number"
                    v-model="form.quantity"
                    class="form-control"
                    placeholder="Quantity"
                  />
                  <div v-if="theErrors.quantity" class="text-danger mt-2">
                    {{ theErrors.quantity[0] }}
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-outline-info">
                    Save
                  </button>
                  <router-link
                    :to="{ name: 'transaction.index' }"
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
        productId: "",
        referenceNo: "",
        price: 0,
        quantity: 0,
      },
      theErrors: [],
      Products: [],
    };
  },
  mounted() {
    this.getProducts();
  },

  methods: {
    async getProducts() {
      let response = await axios.get("http://127.0.0.1:8000/api/v1/products");
      if (response.status == 200) {
        this.Products = response.data.data;
      }
    },
    async create() {
      try {
        let response = await axios.post(
          "http://127.0.0.1:8000/api/v1/transactions",
          this.form
        );
        if (response.status == 200) {
          this.$router.push("/transactions");
        }
      } catch (e) {
        console.log(e.response.data.errors);
        this.theErrors = e.response.data.errors;
      }
    },
    selectedQuantity(e) {
      console.log(e.target.value);
    },
  },
};
</script>
