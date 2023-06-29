<template>
  <div class="container">
    <button class="btn btn-success" @click="addToCart">
      Agregar al carrito
    </button>
  </div>
</template>

<script>
import { mapMutations } from "vuex";
export default {
  props: ["product_id", "cart_id", "amount",],

  data() {
    return {
      cart: [],
    };
  },

  methods: {
    ...mapMutations([
      "addProductInCart",
      "increment",
    ]),
    addToCart() {
      //Busco el producto para agregar al carrito VUEX
      axios.get("/products/get/" + this.product_id).then((respuesta) => {
        this.product = respuesta.data;
        this.product.amount = this.amount;
        this.$store.dispatch("addToCart", this.product);
      });
      //Guardo el producto y carro en la base de datos
      /* axios({
        method: "POST",
        url: this.endpoint,
        data: {
          shopping_cart_id: this.cart_id,
          producto_id: this.product_id,
        },
        headers: {
          Accept: "Application/json",
          "Content-Type": "application/json",
        },
      }).then(() => {
        console.log("ok");
      }); */
    },
  },
  mounted() {},
};
</script>
