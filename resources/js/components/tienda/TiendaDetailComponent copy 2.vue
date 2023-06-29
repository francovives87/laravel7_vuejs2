<template>
  <div class="container">
    <a @click="$router.go(-1)" class="btn btn-primary">X Cerrar</a>
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="card" style="width: 18rem">
            <img :src="product.img" class="card-img-top" alt="" />
            <div class="card-body">
              <h5 class="card-title">{{ product.nombre }}</h5>
              <p class="card-text">
                {{ product.descripcion }}
                <small>Cantidad:</small>
                <input type="number" name="" min="1" v-model.number="amount" />
              </p>
              <div
                class="form-group"
                v-for="(vari, index) in variaciones"
                :key="index"
              >
                <label for="">{{ vari.nombre }}</label>
                <tienda-variation-component
                  :variation_id="vari.id"
                  @clicked="onClickChild"
                ></tienda-variation-component>
              </div>
              <button
                title="button"
                class="btn btn-success"
                @click="addProductWithVariant"
              >
                Agregar al carrito
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapMutations } from "vuex";

export default {
  props: ["product", "variaciones"],
  data() {
    return {
      variationValuesforChild: [],
      amount: 1,
      variationsToadd: [],
      productClear: [],
    };
  },

  computed: {},

  mounted() {
    var simply = JSON.stringify(this.product);
    this.productClear = JSON.parse(simply);
  },

  watch: {},

  methods: {
    ...mapMutations(["addProductInCart", "increment"]),

    addProductWithVariant() {
      var variaciones = [];

      this.variationValuesforChild.forEach(function callback(value, index) {
        variaciones.push(value.nombre);
      });
      this.variationsToadd = variaciones;

      this.product.variaciones= variaciones
      this.product.amount = this.amount

      this.$store.dispatch("addToCart", this.product);
    },

    onClickChild(value) {
      if (
        this.variationValuesforChild.some(
          (elem) => elem.variation_id === value.variation_id
        )
      ) {
        console.log("ya esta");
        var index = this.variationValuesforChild.findIndex(
          (item) => item.variation_id === value.variation_id
        );
        this.variationValuesforChild.splice(index, 1, value);
      } else {
        this.variationValuesforChild.push(value);
      }
      var simply = JSON.stringify(this.variationValuesforChild);
      var clear = JSON.parse(simply);
      console.log(clear);
    },
  },
};
</script>
