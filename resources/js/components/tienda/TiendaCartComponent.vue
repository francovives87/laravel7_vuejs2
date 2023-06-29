<template>
  <div class="container">
    <router-link :to="{ name: 'tiendaHome' }" class="btn btn-primary">
      X cerrar
    </router-link>
    <div class="container">
      <div class="row">
        <p v-bind:totalPrice="totalPrice">total: {{ totalPrice }}</p>
        <router-link
          :to="{
            name: 'checkout',
            params: {
              productsInCart: cart,
              totalPrice: totalPrice,
              tienda_id: this.tienda_id,
            },
          }"
          class="btn btn-primary"
        >
          Finalizar compra
        </router-link>
        <button class="btn btn-primary" v-on:click="LimpiarCarrito()">Limpiar carrito</button>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col" v-for="(item, index) in cart" v-bind:key="index">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{ item.nombre }}</h5>
              <p class="card-text">Precio: {{ item.precio }}</p>
              <p>Cantidad: {{ item.cantidad }}</p>
              <p class="card-text">Total: {{ item.precio * item.cantidad }}</p>
              <input type="number" name="" id="" v-model="item.cantidad" />
              <div class="mt-2">
                <h5>Variaciones:</h5>
                <ul v-for="varis in item.variaciones" :key="varis.id">
                  <li>{{ varis }}</li>
                </ul>

                <button
                  class="btn btn-danger"
                  v-on:click="deleteProductCart(item.id)"
                >
                  Quitar del carrito
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container"></div>
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
      quanty: 1,
      total: 0,
    };
  },

  computed: {
    ...mapGetters(["cart", "count"]),

    totalPrice() {
      let price = 0;
      this.cart.map((el) => {
        price += el["cantidad"] * el["precio"];
      });
      return price;
    },
  },

  props: ["cart_id", "products_in_cart", "tienda_id"],
  mounted() {
    console.log(this.cart);
    console.log("tienda_id:");
    console.log(this.tienda_id);
  },

  methods: {
    ...mapMutations([
      "increment",
      "deleteProductInCart",
    ]),

    ...mapActions([
      "ClearCart",
    ]),

    LimpiarCarrito(){
      this.ClearCart();
    },

    deleteProductCart(product_id) {
      this.deleteProductInCart(product_id);
    },

    Pagar() {
      console.log(this.cart);
      console.log("total");
      console.log(this.totalPrice);
    },
  },
};
</script>
