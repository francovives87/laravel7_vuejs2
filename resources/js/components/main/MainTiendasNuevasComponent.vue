<template>
  <div class="container py-4">
    <h5>Tiendas nuevas:</h5>
    <section class="categorias">
      <div class="container py-2">
        <div class="row py-2">
          <div
            class="col-lg-3"
            v-for="(newTienda, index) in nuevasTiendas"
            :key="index.id"
          >
            <router-link
              :to="{
                name: 'tiendaHome',
                params: {
                  name: newTienda.nombre,
                },
              }"
            >
              <div class="card mb-3 text-center">
                <img
                  src="/storage/shop-2607121_640.jpg"
                  alt=""
                  class="img-fluid"
                />

                <h5>{{ newTienda.nombre }}</h5>
              </div>
            </router-link>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  props: [""],

  data() {
    return {
      nuevasTiendas: [],
    };
  },

  mounted() {
    axios.get("/main/nuevas_tiendas/").then((respuesta) => {
      this.nuevasTiendas = respuesta.data;
    });
  },
};
</script>
