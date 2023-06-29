<template>
  <div class="container">
    <div>
      {{ mensaje }}
    </div>
  </div>
</template>

<script>
export default {
  props: ["product_id", "products"],

  data() {
    return {
      mensaje: "",
      allProducts: [],
      res: [],
    };
  },

  mounted() {
    this.allProducts = this.products;
    this.res = this.allProducts.filter((el) => {
      return el.id === this.product_id;
    });
    axios.get("/cuenta/product/type/" + this.product_id).then((respuesta) => {
      if (respuesta.data > 0) {
        this.mensaje = "Stock en cada variacion";
      } else {
        this.mensaje = this.res[0].stock;
      }
    });
    console.log("allProducts");
    console.log(this.allProducts);
    this.res = this.allProducts.filter((el) => {
      return el.id === this.product_id;
    });
    console.log("=======RES===========");
    console.log(this.res);
    console.log("=======RES===========");
  },

  watch: {
    product_id: function (value) {
      this.allProducts = this.products;
      this.res = this.allProducts.filter((el) => {
        return el.id === this.product_id;
      });
      axios.get("/cuenta/product/type/" + this.product_id).then((respuesta) => {
        if (respuesta.data > 0) {
          this.mensaje = "Stock en cada variacion";
        } else {
          this.mensaje = this.res[0].stock;
        }
      });
      console.log("allProducts");
      console.log(this.allProducts);
      this.res = this.allProducts.filter((el) => {
        return el.id === this.product_id;
      });
      console.log("=======RES===========");
      console.log(this.res);
      console.log("=======RES===========");
    },
  },

  methods: {},
};
</script>
