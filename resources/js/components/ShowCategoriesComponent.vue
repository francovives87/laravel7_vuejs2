<template>
  <div class="container">
    <div
      class="accordion"
      id="accordionExample"
      v-for="(item, index) in this.tiendacategories"
      v-bind:key="index"
    >
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button
              class="btn btn-link btn-block text-left"
              type="button"
              data-toggle="collapse"
              v-bind:data-target="'#collapse' + index"
              aria-expanded="true"
              aria-controls="collapseOne"
              v-on:click="getProducts(item.id)"
            >
              {{ item.nombre }}
            </button>
          </h2>
        </div>

        <div
          v-bind:id="'collapse' + index"
          class="collapse"
          aria-labelledby="headingOne"
          data-parent="#accordionExample"
        >
          <div class="card-body">
            <div v-if="productOnCategories.length">
              <div v-for="product in productOnCategories" :key="product.id">
                <showproducts-component
                  :product="product"
                  :cart_id="cart_id"
                ></showproducts-component>
              </div>
            </div>
            <div v-else>Categoria Vacia!</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["cart_id", "tiendacategories"],
  data() {
    return {
      productOnCategories: [],
    };
  },

  mounted() {
    console.log(this.tiendacategories);
  },

  methods: {
    getProducts(categoriaid) {
      axios.get("/categories/get/" + categoriaid).then((respuesta) => {
        this.productOnCategories = respuesta.data;
        console.log(this.productOnCategories);
      });
    },


    getVariations() {
var filter2 = filter.filter((f) => {
                    var test = f.variaciones.every((v, j) => {
                        return v === nobj.variaciones[j]
                    })
                    return test
                })
    },
  },
};
</script>
