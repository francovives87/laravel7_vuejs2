<template>
  <div class="container">
    <div class="row mt-3">
      <div class="col">
        <h4><i class="fas fa-align-justify"></i> Categorias</h4>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista de categorias</h3>

            <div class="card-tools">
              <button
                class="btn btn-success"
                type="button"
                data-toggle="modal"
                data-target="#exampleModal"
              >
                <i class="fas fa-plus"></i> Agregar nueva categoria
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Imagen</th>
                  <th>Nombre</th>
                  <th>Descripcion</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(categoria, index) in categorias" :key="index.id">
                  <td>{{ categoria.id }}</td>
                  <td>
                    <img
                      :src="categoria.image"
                      alt=""
                      style="height: 50px; width: 50px"
                    />
                  </td>
                  <td>{{ categoria.nombre }}</td>
                  <td>{{ categoria.descripcion }}</td>
                  <td>
                    <button
                      type="button"
                      class="btn btn-warning"
                      data-toggle="modal"
                      data-target="#editModal"
                      @click="SeteditCategorie(categoria)"
                    >
                      Editar
                    </button>

                    |
                    <button
                      type="button"
                      class="btn btn-danger"
                      @click="SetDeleteCategorie(categoria)"
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

    <!-- Modal para crear categoria-->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              Agregar Categoria Nueva
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
              <div class="row">
                <div class="col-md-6">
                  <form
                    action=""
                    method="POST"
                    class="form-group"
                    enctype="multipart/form-data"
                  >
                    <label class="form-group">Nueva categoria</label>
                    <input
                      type="text"
                      name=""
                      id=""
                      class="form-control"
                      placeholder="Nueva categoria"
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

                    <label class="form-group">Cargar imagen:</label>
                    <input
                      type="file"
                      name="image"
                      id=""
                      class="form-control"
                      @change="imageSelected"
                      ref="imageNew"
                    />
                  </form>
                </div>
                <div class="col-md-6">
                  <div v-if="imagePreview" class="image-preview text-center">
                    <img
                      :src="imagePreview"
                      class="figure-img img-fluid"
                      style="max-height: 250px"
                      alt=""
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="submit"
              class="btn btn-success"
              v-on:click="addCategorie()"
            >
              Crear nueva Categoria
            </button>
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

    <!-- Button trigger modal -->

    <!-- Modal para editar categoria -->
    <div
      class="modal fade"
      id="editModal"
      tabindex="-1"
      aria-labelledby="editModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              Editar Categoria:
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
              <div class="row">
                <div class="col-md-6">
                  <form
                    action=""
                    method="post"
                    v-on:submit.prevent="addCategorie()"
                    class="form-group"
                  >
                    <h5>ID categoria #{{ categoria_edit.id }}</h5>
                    <label class="form-group">Nombre de la categoria:</label>
                    <input
                      type="text"
                      name=""
                      id=""
                      class="form-control"
                      placeholder="Nueva categoria"
                      v-model="categoria_edit.nombre"
                    />
                    <label class="form-group">Descripcion</label>
                    <input
                      type="text"
                      name=""
                      id=""
                      class="form-control"
                      v-model="categoria_edit.descripcion"
                    />
                    <label class="form-group">Seleccionar imagen:</label>
                    <input
                      type="file"
                      name="imageEdit"
                      id=""
                      @change="imageSelectedEdit"
                    />
                  </form>
                </div>
                <div class="col-md-6">
                  <div
                    v-if="imagePreviewEdit"
                    class="image-preview text-center"
                  >
                    <img
                      :src="imagePreviewEdit"
                      class="figure-img img-fluid"
                      style="max-height: 250px"
                      alt=""
                    />
                  </div>
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
                  @click="editCategorie()"
                >
                  Actualizar cambios
                </button>
              </div>
            </div>
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
      user_id: Number,
      categorias: [],
      endpointCreate: "/private/categorie/create",
      endpointEdit: "/cuenta/categoria/edit",
      endpointDelete: "/cuenta/categoria/delete",
      nombre: "",
      descripcion: "",
      categoria_edit: [],
      categorie_delete: [],
      image: null,
      imagePreview: null,
      imagePreviewEdit: null,
      imageEdit: "",
    };
  },
  props: ["user", "tienda_id"],
  mounted() {
    /* this.tiendaGet = JSON.parse(this.tienda); */
    console.log("categoria_id");
    console.log(this.tienda_id);

    axios.get("/private/tienda/" + this.user).then((respuesta) => {
      this.user_id = this.user;
    });

    axios.get("/cuenta/categorie/" + this.user).then((respuesta) => {
      console.log(respuesta.data);
      this.categorias = respuesta.data;
    });
  },

  methods: {
    actualizarLista() {
      axios.get("/cuenta/categorie/" + this.user).then((respuesta) => {
        console.log(respuesta.data);
        this.categorias = respuesta.data;
      });
    },

    imageSelected(e) {
      this.image = e.target.files[0];

      let reader = new FileReader();
      reader.readAsDataURL(this.image);
      reader.onload = (e) => {
        this.imagePreview = e.target.result;
      };
    },

    imageSelectedEdit(e) {
      this.imageEdit = e.target.files[0];

      let reader = new FileReader();
      reader.readAsDataURL(this.imageEdit);
      reader.onload = (e) => {
        this.imagePreviewEdit = e.target.result;
      };
    },

    addCategorie() {
      console.log("addCategorie");

      let data = new FormData();
      data.append("tienda_id", this.tienda_id);
      data.append("nombre", this.nombre);
      data.append("descripcion", this.descripcion);
      data.append("image", this.image);

      axios({
        method: "POST",
        url: this.endpointCreate,
        data: data,
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
          this.image = "";
          this.imagePreview = "";
          this.$refs.imageNew.value = ""; //estables una referencia en el input file, y este codigo lo busca y lo vacia!
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    SeteditCategorie(categorie) {
      this.categoria_edit = categorie;
      this.imagePreviewEdit = categorie.image;
    },

    SetDeleteCategorie(categorie) {
      this.categorie_delete = categorie;
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
            this.deleteCategorie();
          }
        });
    },

    deleteCategorie() {
      axios({
        method: "POST",
        url: this.endpointDelete,
        data: {
          categorie_id: this.categorie_delete.id,
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

    editCategorie() {
      let data = new FormData();
      data.append("tienda_id", this.tienda_id);
      data.append("categorie_id", this.categoria_edit.id);
      data.append("categorie_nombre", this.categoria_edit.nombre);
      data.append("categorie_descripcion", this.categoria_edit.descripcion);
      data.append("image", this.imageEdit);
      axios({
        method: "POST",
        url: this.endpointEdit,
        data: data,
        headers: {
          Accept: "Application/json",
          "Content-Type": "application/json",
        },
      })
        .then((respuesta) => {
          console.log(respuesta);
          toast.fire({
            title: "Categoria Actualizada",
            text: "La categoria se ha actualizado con exito!",
            icon: "success",
            confirmButtonText: "Cerrar",
            timer: 3000,
          });
          this.actualizarLista();
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>
