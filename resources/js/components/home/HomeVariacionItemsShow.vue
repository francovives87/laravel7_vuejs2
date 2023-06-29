<template>
  <div class="container">
    <div class="row">
      <div
        class="d-inline m-2 p-2 bg-primary text-whiteary"
        v-for="(item, index) in items"
        :key="index.id"
      >
        <div>{{ item.nombre }}</div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["variacion_id"],
  data() {
    return {
      items: [],
    };
  },

  computed: {},
  watch: {
    variacion_id: function (value) {
      axios
      .get("/cuenta/product/variaciones/items/" + this.variacion_id)
      .then((respuesta) => {
        this.items = respuesta.data;
  
      });
    },
  },
  mounted() {
    axios
      .get("/cuenta/product/variaciones/items/" + this.variacion_id)
      .then((respuesta) => {
        this.items = respuesta.data;
      });
  },
};
</script>
