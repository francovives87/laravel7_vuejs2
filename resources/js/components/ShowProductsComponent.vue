<template>
  <div class="list-group">
    <div class="list-group-item">
      <img src="img/ej1.jpg" alt="" />
      <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-2 mt-2">{{ product.nombre }}</h5>
        <small class="text-muted">3 days ago</small>
      </div>

      <p class="mb-1">{{ product.descripcion }}</p>
      <small>Cantidad:</small>
      <input type="number" name="" min="1" v-model.number="amount" />
      <div class="mt-3">
        <div v-for="vari in variation" :key="vari.id">
          <label for="">{{ vari.nombre }}</label>
          <variation-component
            :variation_id="vari.id"
            @clicked="onClickChild"
          ></variation-component>
        </div>
        <addtocart-component
          :cart_id="cart_id"
          :product_id="product.id"
          :amount="amount"
          :variationValuesforChild="variationValuesforChild"
        ></addtocart-component>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["product", "cart_id"],

  data() {
    return {
      productsTienda: [],
      amount: 1,
      variation: [],
      var_id: Number,
      variationValuesforChild: [],
    };
  },

  methods: {
    onClickChild(value) {
      /*  this.variationValuesforChild.push(value);
      let aNuevo = this.variationValuesforChild.slice(
        this.variationValuesforChild.length - 2
      );
      console.log(aNuevo); // someValue */

      if (
        this.variationValuesforChild.some(
          (elem) => elem.variation_id === value.variation_id
        )
      ) {
        console.log("ya esta");
        var index = this.variationValuesforChild.findIndex(item => item.variation_id === value.variation_id);
        this.variationValuesforChild.splice(index, 1, value);
        
      } else {
        this.variationValuesforChild.push(value);
      }
      console.log(this.variationValuesforChild);
    },
  },

  mounted() {
    axios.get("/products/variation/" + this.product.id).then((respuesta) => {
      this.variation = respuesta.data;
    });
  },

  computed: {},
};
</script>
