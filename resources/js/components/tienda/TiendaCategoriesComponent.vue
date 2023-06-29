<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <carousel
          :autoplay="true"
          :perPageCustom="[
            [360, 1],
            [1024, 3],
          ]"
          :navigationEnabled="true"
        >
          <slide
            v-for="(categorie, index) in this.categoriesTienda"
            :key="index.id"
          >
            <div v-on:click="showProduct(categorie.id)">
              <img class="img-slider" :src="categorie.image" alt="" />
              <h4>{{ categorie.nombre }}</h4>
            </div>
          </slide>
        </carousel>
      </div>
    </div>
    <section>
      Productosxx:
      <div class="container">
        <div v-if="productsOnCategorie.length">
          <div v-for="(product, index) in productsOnCategorie" :key="index.id">
            <tienda-product-component
            :product="product"
            ></tienda-product-component>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import TiendaProductComponent from './TiendaProductComponent.vue';
export default {
  components: { TiendaProductComponent },
  data() {
    return {
      component: "",
      nombreDeTienda: String,
      categoriesTienda: [],
      productsOnCategorie: [],
    };
  },

  methods: {
    showProduct(id) {
      axios.get("/categories/get/" + id).then((respuesta) => {
        this.productsOnCategorie = respuesta.data;
        console.log(this.productsOnCategorie);
      });
    },
  },

  mounted() {
    this.nombreDeTienda = this.$route.params.name;
    axios.get("/tienda/get/" + this.nombreDeTienda).then((respuesta) => {
      this.categoriesTienda = respuesta.data.categorias;
      console.log(this.categoriesTienda);
    });
  },
};
</script>

<style>
#container {
  padding: 0 60px;
}

.VueCarousel-slide {
  position: relative;
  background: #fff;
  color: #000;
  font-family: Arial;
  font-size: 24px;
  text-align: center;
  min-height: 100px;
}

.label {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
</style>
