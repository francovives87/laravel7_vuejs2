<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">facturacion</div>

          <div class="card-body">
            <form>
              <div class="form-group">
                <label for="nombre">nombre</label>
                <input
                  type="text"
                  class="form-control"
                  name="nombre"
                  id="nombre"
                  required
                  v-model="nombre"
                />
              </div>
              <div class="form-group">
                <label for="apellido">apellido</label>
                <input
                  type="text"
                  class="form-control"
                  name="apellido"
                  id="apellido"
                  required
                  v-model="apellido"
                />
              </div>
              <div class="form-group">
                <label for="pais">pais</label>
                <input
                  type="text"
                  class="form-control"
                  name="pais"
                  id="pais"
                  required
                  v-model="pais"
                />
              </div>
              <div class="form-group">
                <label for="direccion_calle">direccion </label>
                <input
                  type="text"
                  class="form-control"
                  name="calle_numero"
                  id="calle_numero"
                  placeholder="Nombre de la calle y numero de la casa"
                  required
                  v-model="direccion"
                />
                <input
                  type="text"
                  class="form-control"
                  name="apartamento"
                  id="apartamento"
                  placeholder="Apartamento,habitacion,etc,(opcional)"
                  v-model="apartamento"
                />
              </div>
              <div class="form-group">
                <label for="ciudad">Localidad/Ciudad</label>
                <input
                  type="text"
                  class="form-control"
                  name="ciudad"
                  id="ciudad"
                  required
                  v-model="ciudad"
                />
              </div>
              <div class="form-group">
                <label for="provincia">Region/Provincia</label>
                <input
                  type="text"
                  class="form-control"
                  name="provincia"
                  id="provincia"
                  required
                  v-model="provincia"
                />
              </div>
              <div class="form-group">
                <label for="codigoPostal">codigo postal</label>
                <input
                  type="text"
                  class="form-control"
                  name="codigoPostal"
                  id="codigoPostal"
                  required
                  v-model="codigopostal"
                />
              </div>
              <div class="form-group">
                <label for="telefono">Telefono</label>
                <input
                  type="text"
                  class="form-control"
                  name="telefono"
                  id="telefono"
                  v-model="telefono"
                  required
                />
              </div>
              <div class="form-group">
                <label for="email">Correo electronico</label>
                <input
                  type="email"
                  class="form-control"
                  name="email"
                  id="email"
                  required
                  v-model="email"
                />
              </div>
              <div class="form-group">
                <label for="notes">Notas del pedido (opcional)</label>
                <input
                  type="text"
                  class="form-control"
                  name="notes"
                  id="notes"
                  v-model="notas"
                />
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-mb-6">
        <div class="card">
          <div class="card-header">Tu pedido</div>
          <div class="card-body">
            <h5 class="card-title">Productos</h5>
            <ul
              class="list-group"
              v-for="(item, index) in productsInCart"
              :key="index.id"
            >
              <li class="list-group-item">
                <h4>{{ item.nombre }}</h4>
                <p>Cantidad: {{ item.cantidad }}</p>
                <p>Precio: {{ item.precio }}</p>
                <p>Variaciones: {{ item.variaciones }}</p>
                <p>Subtotal: {{ item.cantidad * item.precio }}</p>
              </li>
            </ul>
            <h5>Total: {{ totalPrice }}</h5>
          </div>
        </div>
        <div class="card mt-2">
          <h5 class="card-header">Metodo de pago</h5>
          <div class="card-body">
            <h5 class="card-title">Seleccione un metodo de pago</h5>
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="exampleRadios"
                id="exampleRadios1"
                value="whatsapp"
                checked
                v-model="metodo_pago"
              />
              <label class="form-check-label" for="exampleRadios1">
                Ordenar por WhatsApp
              </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="exampleRadios"
                id="exampleRadios2"
                value="mercadopago"
                v-model="metodo_pago"
              />
              <label class="form-check-label" for="exampleRadios2">
                Pagar con MercadoPago
              </label>
            </div>
          </div>
          <button class="btn btn-success" v-on:click="CreateOrden()">
            Finalizar Compra
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
  props: ["productsInCart", "totalPrice", "tienda_id"],

  data() {
    return {
      endpointGuardarDatosCliente: "/checkout/create",
      nombre: "",
      apellido: "",
      pais: "",
      direccion: "",
      apartamento: "",
      ciudad: "",
      provincia: "",
      codigopostal: "",
      telefono: "",
      email: "",
      notas: "",
      metodo_pago: "",
    };
  },
  mounted() {
    console.log(this.productsInCart);
    console.log(this.totalPrice);
    console.log("tienda_id");
    console.log(this.tienda_id);
  },

  methods: {
    ...mapActions(["ClearCart"]),

    CreateOrden() {
      var listaDeProductosSimply = JSON.stringify(this.productsInCart);
      axios({
        method: "POST",
        url: this.endpointGuardarDatosCliente,
        data: {
          tienda_id: this.tienda_id,
          nombre: this.nombre,
          apellido: this.apellido,
          pais: this.pais,
          direccion: this.direccion,
          apartamento: this.apartamento,
          ciudad: this.ciudad,
          provincia: this.provincia,
          codigopostal: this.codigopostal,
          telefono: this.telefono,
          email: this.email,
          notas: this.notas,
          metodo_pago: this.metodo_pago,
          total: this.totalPrice,
          //Lista de productos
          listaDeProductos: listaDeProductosSimply,
        },
        headers: {
          Accept: "Application/json",
          "Content-Type": "application/json",
        },
      })
        .then((respuesta) => {
          console.log(respuesta);
          if (respuesta.statusText === "OK") {
            this.ClearCart();
            this.$router.push({ name: "compraSuccess" }); //Cambio la vista si todo salio ok
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>
