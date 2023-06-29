<template>
  <div class="container">
    <div class="row">
      <div class="col">
        <select
          v-model="itemSel"
          class="form-control"
          id="docente"
        >
          <option
            v-for="(vari, index) in itemsOnVarations"
            :key="index"
            v-on:click="onClickButton(vari)"
          >
            {{ vari.nombre }}
          </option>
        </select>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["variation_id", "value", "clear"],
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

  watch: {
    clear: function (value) {
      console.log(value);
      this.itemSel = "";
    },


  },

  mounted() {
    axios
      .get("/products/variation/item/" + this.variation_id)
      .then((respuesta) => {
        this.itemsOnVarations = respuesta.data;
      });
  },
};
</script>
