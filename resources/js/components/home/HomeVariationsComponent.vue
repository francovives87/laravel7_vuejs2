<template>
  <div class="container">
    <div class="row mt-3">
      <div class="col">
        <h4><i class="fas fa-asterisk"></i> Variaciones</h4>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista de Items:</h3>

            <div class="card-tools">
              <button
                class="btn btn-success"
                type="button"
                data-toggle="modal"
                data-target="#exampleModal"
              >
                <i class="fas fa-plus"></i> Crear nueva variacion
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(variacion, index) in variaciones" :key="index.id">
                  <td>{{ variacion.nombre }}</td>
                  <td>
                    <button
                      type="button"
                      class="btn btn-warning"
                      data-toggle="modal"
                      data-target="#editGVariationModal"
                      @click="SetEditGVariation(variacion)"
                    >
                      Editar Variacion
                    </button>

                    |
                    <button
                      type="button"
                      class="btn btn-danger"
                      @click="SetDeleteGVariation(variacion)"
                    >
                      Eliminar
                    </button>
                    |
                    <button
                      type="button"
                      class="btn btn-primary"
                      @click="GetItemsOfGVariation(variacion)"
                    >
                      Items
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>

    <!-- modal para editar variacion -->
    <!-- Modal -->
    <div
      class="modal fade"
      id="editGVariationModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Variacion</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form
              action=""
              method="post"
              v-on:submit.prevent="addCategorie()"
              class="form-group"
            >
              <h5>ID Variacion: #{{ gVariationEdit.id }}</h5>
              <label class="form-group">Nombre de la variacion:</label>
              <input
                type="text"
                name=""
                id=""
                class="form-control"
                placeholder="Nueva categoria"
                v-model="gVariationEdit.nombre"
              />
              <label class="form-group">Breve Descripcion</label>
              <input
                type="text"
                name=""
                id=""
                class="form-control"
                v-model="gVariationEdit.description"
              />
            </form>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
            <button
              type="button"
              class="btn btn-success"
              @click="updateGVariation()"
            >
              Actualizar cambios
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-12">
        <div class="card" v-if="showItemList == 1">
          <div class="card-header">
            <h2># {{ nameVaritionToItemEdit }}</h2>
            <h3 class="card-title">Lista de Items:</h3>

            <div class="card-tools">
              <button
                type="button"
                class="btn btn-success"
                data-toggle="modal"
                data-target="#addItemModal"
              >
                <i class="fas fa-plus"></i> Crear nuevo Item
              </button>
              <button
                type="button"
                class="btn btn-secondary"
                v-on:click="showItemList = 0"
              >
                <i class="fas fa-times"></i> Cerrar
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(gitem, index) in gItemsList" :key="index.id">
                  <td>{{ gitem.nombre }}</td>
                  <td>
                    <button
                      type="button"
                      class="btn btn-warning"
                      data-toggle="modal"
                      data-target="#editGItemModal"
                      v-on:click="SetToEditGItem(gitem)"
                    >
                      Editar
                    </button>

                    |
                    <button
                      type="button"
                      class="btn btn-danger"
                      @click="SetDeleteGItem(gitem)"
                    >
                      Eliminar
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>

    <!-- Modal para crear Varuacion generica-->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              Agregar Nueva Variacion
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container">
              <form
                action=""
                method="post"
                v-on:submit.prevent="addVariation()"
                class="form-group"
              >
                <label class="form-group">Nueva Variacion:</label>
                <input
                  type="text"
                  name=""
                  id=""
                  class="form-control"
                  placeholder="Nueva Variacion"
                  v-model="nombre"
                />
                <label class="form-group">Descripcion</label>
                <input
                  type="text"
                  name=""
                  id=""
                  class="form-control"
                  v-model="descripcion"
                />
                <button type="submit" class="btn btn-success mt-2">
                  Crear nueva variacion
                </button>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
          </div>
        </div>
      </div>
    </div>

    <!--  modal para agregar nuevo GItems -->
    <!-- Modal -->
    <div
      class="modal fade"
      id="addItemModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              Agregar nuevo item a la variacion {{ nameVaritionToItemEdit }}.
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="">Nombre del nuevo item:</label>
              <input
                type="text"
                name=""
                id=""
                class="form-group"
                v-model="GItemNombre"
              />
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
            <button
              type="button"
              class="btn btn-success"
              v-on:click="CreateGItem()"
            >
              Crear Item
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal para editar un GItem-->
    <div
      class="modal fade"
      id="editGItemModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar item.</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="">Nombre:</label>
              <input
                type="text"
                name=""
                id=""
                class="form-control"
                v-model="gitemNameToEdit"
              />
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
            <button
              type="button"
              class="btn btn-success"
              v-on:click="EditGItem()"
            >
              Actualizar Cambios
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      variaciones: [],
      endpointCreate: "/cuenta/gvariations/create",
      endpointEdit: "/cuenta/gvariations/edit",
      endpointDelete: "/cuenta/gvariations/delete",
      endpointGItemCreate: "/cuenta/gitem/create",
      endpointGItemEdit: "/cuenta/gitem/edit",
      endpointGItemDelete: "/cuenta/gitem/delete",
      nombre: "",
      descripcion: "",
      gVariationEdit: [],
      gVariation_delete: [],
      variationSelect: "",
      gItemsList: [],
      categoria_edit: "",
      nameVaritionToItemEdit: "",
      showItemList: 0,
      GItemNombre: "",
      gvariationIdForGitemNew: Number,
      GItem_id: Number,
      gitemNameToEdit: "",
      gItemToDelete: [],
    };
  },
  props: ["user", "tienda_id"],
  mounted() {
    /* this.tiendaGet = JSON.parse(this.tienda); */
    console.log("categoria_id");
    console.log(this.tienda_id);

    axios.get("/cuenta/gvariations/" + this.tienda_id).then((respuesta) => {
      console.log(respuesta.data);
      this.variaciones = respuesta.data;
    });
  },

  methods: {
    actualizarLista() {
      axios.get("/cuenta/gvariations/" + this.tienda_id).then((respuesta) => {
        console.log(respuesta.data);
        this.variaciones = respuesta.data;
      });
    },

    actualizarListaGItems() {
      axios
        .get("/cuenta/gvariations/gitems/" + this.gvariationIdForGitemNew)
        .then((respuesta) => {
          this.gItemsList = respuesta.data;
        });
    },

    /* GITEMS */

    GetItemsOfGVariation(variacion) {
      axios
        .get("/cuenta/gvariations/gitems/" + variacion.id)
        .then((respuesta) => {
          this.gItemsList = respuesta.data;
          this.showItemList = 1;
        });
      this.nameVaritionToItemEdit = variacion.nombre;
      this.gvariationIdForGitemNew = variacion.id;
    },

    CreateGItem() {
      axios({
        method: "POST",
        url: this.endpointGItemCreate,
        data: {
          gvariation_id: this.gvariationIdForGitemNew,
          gitem_nombre: this.GItemNombre,
        },
        headers: {
          Accept: "Application/json",
          "Content-Type": "application/json",
        },
      })
        .then((respuesta) => {
          console.log(respuesta);
          toast.fire({
            title: "Nueva Categoria",
            text: "Se ha creado la nueva categoria!",
            icon: "success",
            confirmButtonText: "Aceptar",
            timer: 3000,
          });
          this.actualizarListaGItems();
          this.nombre = "";
          this.descripcion = "";
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    SetToEditGItem(gitem) {
      this.GItem_id = gitem.id;
      this.gitemNameToEdit = gitem.nombre;
    },

    EditGItem() {
      axios({
        method: "POST",
        url: this.endpointGItemEdit,
        data: {
          gitem_id: this.GItem_id,
          gitem_nombre: this.gitemNameToEdit,
        },
        headers: {
          Accept: "Application/json",
          "Content-Type": "application/json",
        },
      })
        .then((respuesta) => {
          console.log(respuesta);
          toast.fire({
            title: "Item Actualizado",
            text: "El item se ha actualizado con exito!",
            icon: "success",
            confirmButtonText: "Cerrar",
            timer: 3000,
          });
          this.actualizarListaGItems();
          this.variationSelect = "";
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    SetDeleteGItem(gitem) {
      this.gItemToDelete = gitem;
      toast
        .fire({
          title: "¿Esta seguro?",
          text: "Esta a punto de eliminar este item!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          cancelButtonText: "Cancelar",
          confirmButtonText: "SI, quiero borrarlo!",
        })
        .then((result) => {
          if (result.isConfirmed) {
            //
            this.deleteGItem();
          }
        });
    },

    deleteGItem() {
      axios({
        method: "POST",
        url: this.endpointGItemDelete,
        data: {
          gitem_id: this.gItemToDelete.id,
        },
        headers: {
          Accept: "Application/json",
          "Content-Type": "application/json",
        },
      })
        .then((respuesta) => {
          console.log(respuesta);
          toast.fire(
            "Categoria Eliminada!",
            "Se ah eliminado la categoria exitosamente.",
            "success"
          );
          this.actualizarListaGItems();
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    /* GVARATIONS */

    addVariation() {
      console.log("addCategorie");

      //Guardo el producto y carro en la base de datos
      axios({
        method: "POST",
        url: this.endpointCreate,
        data: {
          tienda_id: this.tienda_id,
          nombre: this.nombre,
          descripcion: this.descripcion,
        },
        headers: {
          Accept: "Application/json",
          "Content-Type": "application/json",
        },
      })
        .then((respuesta) => {
          console.log(respuesta);
          toast.fire({
            title: "Nueva Categoria",
            text: "Se ha creado la nueva categoria!",
            icon: "success",
            confirmButtonText: "Aceptar",
            timer: 3000,
          });
          this.actualizarLista();
          this.nombre = "";
          this.descripcion = "";
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    SetEditGVariation(gvariation) {
      this.gVariationEdit = gvariation;
    },

    SetDeleteGVariation(gvariation) {
      this.gVariation_delete = gvariation;
      toast
        .fire({
          title: "¿Esta seguro?",
          text: "Esta a punto de eliminar una categoria!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          cancelButtonText: "Cancelar",
          confirmButtonText: "SI, quiero borrarla!",
        })
        .then((result) => {
          if (result.isConfirmed) {
            //
            this.deleteGVariation();
          }
        });
    },

    deleteGVariation() {
      axios({
        method: "POST",
        url: this.endpointDelete,
        data: {
          gvariation_id: this.gVariation_delete.id,
        },
        headers: {
          Accept: "Application/json",
          "Content-Type": "application/json",
        },
      })
        .then((respuesta) => {
          console.log(respuesta);
          toast.fire(
            "Categoria Eliminada!",
            "Se ah eliminado la categoria exitosamente.",
            "success"
          );
          this.actualizarLista();
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    updateGVariation() {
      axios({
        method: "POST",
        url: this.endpointEdit,
        data: {
          gvariation_id: this.gVariationEdit.id,
          variNombreUpdate: this.gVariationEdit.nombre,
          varidescriptionUpdate: this.gVariationEdit.description,
        },
        headers: {
          Accept: "Application/json",
          "Content-Type": "application/json",
        },
      })
        .then((respuesta) => {
          console.log(respuesta);
          toast.fire({
            title: "Variacion Actualizada",
            text: "La variacion se ha actualizado con exito!",
            icon: "success",
            confirmButtonText: "Cerrar",
            timer: 3000,
          });
          this.actualizarLista();
          this.variationSelect = "";
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>
