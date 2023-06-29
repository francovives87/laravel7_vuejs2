<template>
  <div class="container">
    <div class="card" style="width: 18rem">
      <img :src="product.img" class="card-img-top" alt="..." />
      <div class="card-body">
        <h5 class="card-title">{{ product.nombre }}</h5>
        <p class="card-text">
          {{ product.descripcion }}
        </p>
        <small>Cantidad:</small>
        <input type="number" name="" min="1" v-model.number="amount" />
        <div v-if="variation.length"></div>
      </div>
      <tienda-add-cart-component
        :product_id="product.id"
      ></tienda-add-cart-component>
      <router-link
        :to="{
          name: 'productDetail',
          params: { product: this.productDetail, variaciones: this.variation },
        }"
        class="btn btn-primary"
      >
        Ver detalles
      </router-link>
    </div>
  </div>
</template>

<script>
import TiendaAddCartComponent from "./TiendaAddCartComponent.vue";
import TiendaVariationComponent from "./TiendaVariationComponent.vue";
export default {
  components: { TiendaVariationComponent, TiendaAddCartComponent },
  props: ["product"],
  data() {
    return {
      variation: [],
      variationValuesforChild: [],
      variaciones: [{}],
      productWithVari: [{ producto: Number, variacion: "" }],
      productDetail: [],
      amount:1,
    };
  },
  computed: {},
  watch: {
    product: function (value) {
      axios.get("/products/variation/" + value.id).then((respuesta) => {
        this.variation = respuesta.data;
        console.log("variations======");
        console.log(this.variation);
      });
    },
  },

  mounted() {
    this.productDetail = this.product;
    axios.get("/products/variation/" + this.product.id).then((respuesta) => {
      this.variation = respuesta.data;
      console.log("variations======");
      console.log(this.variation);
    });
  },

  methods: {
    onClickChild(value) {},
  },
};
</script>
