<template>
  <div class="container">
    <div v-if="tipoDeProducto > 0">Producto con variaciones</div>
    <div v-else>Producto Simple</div>
  </div>
</template>

<script>
export default {
  props: ["product_id"],
  data() {
    return {
      tipoDeProducto: 0,
    };
  },
  mounted() {
    axios.get("/cuenta/product/type/" + this.product_id).then((respuesta) => {
      this.tipoDeProducto = respuesta.data;
    });
  },
  watch: {
    product_id: function (value) {
       axios.get("/cuenta/product/type/" + this.product_id).then((respuesta) => {
      this.tipoDeProducto = respuesta.data;
    });
    },
  },
  methods: {},
};
</script>
