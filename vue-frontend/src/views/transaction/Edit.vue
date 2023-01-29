<template>
  <div>
    <Navigation2 />
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-5 mt-5">
          <div class="card">
            <div class="card-header">
              Edit transaction
            </div>
            <div class="card-body">
              <form method="post" @submit.prevent="update" autocomplete="off">
                <div class="form-group">
                  <label>Product Name *</label>
                  <select @change="selectedProduct" class="form-control">
                    <option
                      :value="form.product_id"
                      v-text="form.product.name"
                    ></option>
                    <template v-for="product in Products">
                      <option
                        v-if="form.product_id !== product.id"
                        :key="product.id"
                        :value="product.id"
                      >
                        {{ product.name }}
                      </option>
                    </template>
                  </select>
                  <div v-if="theErrors.productId" class="text-danger mt-2">
                    product is required.
                  </div>
                </div>
                <div class="form-group">
                  <label>Reference No *</label>
                  <input
                    type="text"
                    v-model="form.reference_no"
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
                    Update
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
      form: [],
      theErrors: [],
      Products: [],
      ProductSelected: "",
    };
  },
  mounted() {
    this.Edit();
    this.getProducts();
  },

  methods: {
    async Edit() {
      let response = await axios.get(
        `http://127.0.0.1:8000/api/v1/transactions/${this.$route.params.id}`
      );
      this.form = response.data.data;
    },
    async getProducts() {
      let response = await axios.get("http://127.0.0.1:8000/api/v1/products");
      if (response.status == 200) {
        this.Products = response.data.data;
      }
    },
    async update() {
      try {
        this.form["ProductId"] = this.form.product_id;
        this.form["paymentAmount"] = this.form.payment_amount;
        this.form["referenceNo"] = this.form.reference_no;
        this.form["productId"] = this.ProductSelected || this.form.product_id;
        let response = await axios.put(
          `http://127.0.0.1:8000/api/v1/transactions/${this.$route.params.id}`,
          this.form
        );
        if (response.status == 200) {
          this.$router.push("/transactions");
        }
      } catch (e) {
        this.theErrors = e.response.data.errors;
      }
    },
    selectedProduct(e) {
      this.ProductSelected = e.target.value;
    },
  },
};
</script>
