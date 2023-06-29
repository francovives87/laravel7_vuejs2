<template>
  
    <div class="row">
      <div class="col">
        <!-- Button trigger modal -->
        <button
          type="button"
          class="btn btn-primary"
          data-toggle="modal"
          data-target="#exampleModal"
        >
          Launch demo modal
        </button>
      </div>
        <div class="col">
          <h5>{{ this.count }}</h5>
        </div>
     
    

    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          {{prod}}
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row justify-content-center">{{ cart_id }}</div>

            <div class="container">
              <div class="row">
                <div
                  class="col"
                  v-for="(item, index) in cart"
                  v-bind:key="index"
                >
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">{{ item.nombre }}</h5>
                      <p class="card-text">{{ item.precio }}</p>
                      <p>Cantidad: {{item.amount}}</p>
                      <input type="number" name="" id="" v-bind:value="item.amount">
                     <!--  <input type="number" name="" id="" min="1"  v-bind:value="item.pivot.amount"> -->
                      <div class="mt-2">
                        <div>
                          <h5>Variaciones:</h5>
                          <ul v-for="varis in item.varations" :key="varis.id">
                            <li>{{varis.nombre}}</li>
                          </ul>
                        </div>
                      <button class="btn btn-danger" v-on:click="deleteProductCart(item.id)">
                        Quitar del carrito
                      </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions, mapState, mapMutations } from "vuex";

export default {
  data() {
    return {
      products: [],
      countProduct: Number,
      test: 5,
      getCart: Number,
    };
  },

  created() {},

  computed: {
    ...mapGetters(["cart", "count","prod"]),
  },

  props: ["cart_id", "products_in_cart"],
  mounted() {
    axios.get("/cart/get/" + this.cart_id).then((respuesta) => {
      console.log(respuesta);
    });
    axios.get("/cart/products/" + this.cart_id).then((respuesta) => {
      this.products = respuesta.data;
      this.setProductsIncart(this.products);
      console.log(respuesta);
    });
    axios.get("/cart/products/counts/" + this.cart_id).then((respuesta) => {
      this.setCount(respuesta.data);
      console.log(respuesta);
    });
  },

  methods: {
    ...mapMutations([
      "increment",
      "setProductsIncart",
      "setCount",
      "deleteProductInCart",
    ]),

    deleteProductCart(product_id) {
      axios({
        method: "DELETE",
        url: "/cart/products/delete",
        data: {
          cart_id: this.cart_id,
          product_id: product_id,
        },
        headers: {
          Accept: "Application/json",
          "Content-Type": "application/json",
        },
      }).then((respuesta) => {
        console.log(respuesta);
        this.deleteProductInCart(product_id);
      });
    },
  },
};
</script>
