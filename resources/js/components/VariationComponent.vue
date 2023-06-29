<template>
  <div>
    <div class="contaier mb-2">
      <div class="row">
        <div class="col-6">
          <select v-model="itemSel" class="form-control" id="docente">
            <option v-for="(value,index) in itemsOnVarations" :key="index" v-on:click="onClickButton(value)">
            {{value.nombre}}
            </option>
          </select>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["variation_id"],
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
      .get("/products/variation/item/" + this.variation_id)
      .then((respuesta) => {
        this.itemsOnVarations = respuesta.data;
      });
  },
};
</script>
