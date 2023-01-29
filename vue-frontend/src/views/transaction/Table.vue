<template>
  <div>
    <Navigation2 />
    <div class="container mt-5">
      <div class="d-flex justify-content-between">
        <h3>Transactions</h3>
        <router-link
          :to="{ name: 'transaction.create' }"
          class="btn btn-primary mb-3"
          title="Create"
          >Create</router-link
        >
      </div>
      <div class="table table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Product Name</th>
              <th>Reference No</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Payment Amount</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="transaction in Transactions" :key="transaction.id">
              <td>{{ transaction.product.name }}</td>
              <td>{{ transaction.reference_no }}</td>
              <td>{{ transaction.price }}</td>
              <td>{{ transaction.quantity }}</td>
              <td>{{ transaction.payment_amount }}</td>
              <td class="col-2">
                <router-link
                  :to="{
                    name: 'transaction.edit',
                    params: { id: transaction.id },
                  }"
                  class="btn btn-warning btn-sm"
                  title="Edit"
                  >Edit</router-link
                >
                &nbsp;
                <delete-transaction
                  :endpoint="transaction.id"
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
import DeleteTransaction from "./Delete";
import Navigation2 from "../../components/Navigation2";
export default {
  components: {
    Navigation2,
    DeleteTransaction,
  },

  data() {
    return {
      Transactions: [],
    };
  },

  mounted() {
    this.getTransactions();
  },

  methods: {
    async getTransactions() {
      let response = await axios.get(
        "http://127.0.0.1:8000/api/v1/transactions"
      );
      this.Transactions = response.data.data.data;
    },
  },
};
</script>
