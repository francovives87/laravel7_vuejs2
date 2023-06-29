<template>
  <div class="container">

        <select v-model="itemSel" class="form-control" id="docente">
          <option
            v-for="(vari, index) in itemsOnVarations"
            :key="index"
            v-on:click="onClickButton(vari)"
          >
            {{ vari.nombre }}
          </option>
        </select>

  </div>
</template>

<script>
export default {
  props: ["atributo_id", "value"],
  data() {
    return {
      itemsOnVarations: [],
      itemSel: "",
    };
  },
  methods: {
    onClickButton(value) {
      this.$emit("clicked", value);
    },
  },

  mounted() {
    axios
      .get("/products/variation/item/" + this.atributo_id)
      .then((respuesta) => {
        this.itemsOnVarations = respuesta.data;
      });
  },
};
</script>
