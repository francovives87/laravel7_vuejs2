<template>
  <div class="container">
    <div class="row">
      <div class="col">
        <a @click="$router.go(-1)" class="btn btn-primary">X Cerrar</a>

        <!--         Trabajando con Atributos -->

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
                    <input type="number" name="" min="1" v-model="cantidad" />
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

                  <div
                    class="alert alert-success"
                    role="alert"
                    v-if="disponible === 1"
                  >
                    <h5>El producto esta disponible en estas variaciones!</h5>
                    <span>Cantidades disponibles: {{ stocki }}</span>
                  </div>
                  <div
                    class="alert alert-danger"
                    role="alert"
                    v-if="disponible === 2"
                  >
                    <h5>
                      El producto No esta disponible en estas variaciones!
                    </h5>

                    <span>Cantidades disponibles: {{ stocki }}</span>
                  </div>
                  <button
                    title="button"
                    class="btn btn-success"
                    :disabled="botonEnable === 0"
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
    </div>
  </div>
</template>

<script>
import { mapMutations } from "vuex";

export default {
  props: ["product", "variaciones"],
  data() {
    return {
      endpointCheckVariaciones: "/products/variaciones/check",
      endpointCheckStock: "/products/variaciones/stock/",
      variationValuesforChild: [],
      cantidad: 1,
      disponible: 0,
      variacion_id: 0,
      countVariaciones: 0,
      respuestaDB: [],
      stocki: -1, //lo monto en -1, para que cuando hago la primer consulta y se negativa, mueva el stock a 0, y se muestr el cambio siempre
      botonEnable: 0,
    };
  },

  watch: {
    stocki: function (value) {
      this.stocki = value;
      if (this.stocki > 0) {
        this.disponible = 1;
        this.botonEnable = 1;
      }
      if (this.stocki === 0) {
        this.disponible = 2;
        this.botonEnable = 0;
      }
    },
  },

  mounted() {
    console.log(this.variaciones);

    console.log("product_id");
    console.log(this.product.id);
  },

  methods: {
    ...mapMutations(["addProductInCart", "increment"]),

    addProductWithVariant() {
      var variaciones = [];

      this.variationValuesforChild.forEach(function callback(value, index) {
        variaciones.push(value.nombre);
      });
      this.product.variaciones = variaciones;
      this.product.cantidad = this.cantidad;
      this.product.variacion_id = this.variacion_id;

      this.$store.dispatch("addToCart", this.product);
    },

    onClickChild(value) {
      if (
        this.variationValuesforChild.some(
          (elem) => elem.variation_id === value.variation_id
        )
      ) {
        var index = this.variationValuesforChild.findIndex(
          (item) => item.variation_id === value.variation_id
        );
        this.variationValuesforChild.splice(index, 1, value);
      } else {
        this.variationValuesforChild.push(value);
      }
      console.log(this.variationValuesforChild);

      var items = [];

      this.variationValuesforChild.forEach((item) => {
        items.push(item.id);
      });

      console.log("====items=====");
      console.log(items);
      console.log("====items=====");

      //Trabajo con las variaciones//

      this.countVariaciones = this.variaciones.length;

      if (items.length === this.countVariaciones) {
        console.log("aca busco!");
        var itemsSimply = JSON.stringify(items);
        axios({
          method: "POST",
          url: this.endpointCheckVariaciones,
          data: {
            product_id: this.product.id,
            items: itemsSimply,
          },
          headers: {
            Accept: "Application/json",
            "Content-Type": "application/json",
          },
        })
          .then((respuesta) => {
            console.log("=========Respuesta desde laravel===========");
            console.log(respuesta);
            var srt = JSON.stringify(respuesta.data);
            var simply = JSON.parse(srt);
            this.respuestaDB = simply;
            this.Chequear();
          })
          .catch(function (error) {
            console.log(error);
          });
      }
    },

    /* mi metodo para encontrar que variacion es, busco en la tabla item_variaciones
       la variaciones_id que se repiten la cantidad de veces que tiene de atributos(varations, tengo que reestructurar)
       este productos, si este producto tiene 3 atributos (color,talle,genero), 
       la variacion_id correcta sera la que se repitas 3 veces en la tabla item_variaciones
    */
    Chequear() {
      var arrayDeVariacionesId = [];
      this.stocki = 0;

      this.respuestaDB.map((el) => {
        arrayDeVariacionesId.push(el.variacion_id);
      });
      console.log("====arrayDeVariacionesId====");
      console.log(arrayDeVariacionesId);

      var masrepetido = this.masRepetido(arrayDeVariacionesId);

      console.log("el mas repetido es :");
      console.log(masrepetido);

      var count = this.count(arrayDeVariacionesId, masrepetido);
      console.log("se repite tantas veces");
      console.log(count);

      //si el mas repetido coincide con el numero de atributos, es el correto
      //y buscamos el stock
      if (count === this.countVariaciones) {
        console.log("este es el id que buscamos");
        this.variacion_id = masrepetido;
        console.log(masrepetido);
        this.Disponible(masrepetido);
      }
    },

    Disponible(variacion_id) {
      var kk = [];
      var dame = 0;
      axios
        .get("/products/variaciones/stock/" + variacion_id)
        .then((respueta) => {
          kk = respueta.data;
          kk.forEach((k) => {
            dame = k.stock;
          });
          this.stocki = dame;
        });
    },

    masRepetido(array) {
      if (array.length == 0) return null;
      var modeMap = {};
      var maxEl = array[0],
        maxCount = 1;
      for (var i = 0; i < array.length; i++) {
        var el = array[i];
        if (modeMap[el] == null) modeMap[el] = 1;
        else modeMap[el]++;
        if (modeMap[el] > maxCount) {
          maxEl = el;
          maxCount = modeMap[el];
        }
      }
      return maxEl;
    },

    count(array, toCount) {
      var count = 0;
      for (var i = 0; i < array.length; ++i) {
        if (array[i] == toCount) count++;
      }
      return count;
    },
  },
};
</script>


