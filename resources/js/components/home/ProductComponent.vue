<template>
  <div class="container">
    <div class="row mt-3">
      <div class="col">
        <h4><i class="fab fa-product-hunt"></i> {{ title }}</h4>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-12">
        <div class="card" v-if="productModal == 1">
          <div class="card-header">
            <h3 class="card-title">Lista de Productos</h3>

            <div class="card-tools">
              <button
                class="btn btn-success"
                type="button"
                data-toggle="modal"
                data-target="#exampleModal"
              >
                <i class="fas fa-plus"></i> Agregar Producto
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
                  <th>Tipo</th>
                  <th>Stock</th>
                  <th>Precio</th>
                  <th>Categoria</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(product, index) in products" :key="index.id">
                  <td>{{ product.id }}</td>
                  <td>
                    <img
                      :src="product.img"
                      alt=""
                      style="height:50px;width:50px;"
                    />
                  </td>
                  <td>{{ product.nombre }}</td>
                  <td>{{ product.descripcion }}</td>
                  <td>
                    <home-type-product-component :product_id="product.id">
                    </home-type-product-component>
                  </td>
                  <td>
                    <home-stock-product-component
                      :product_id="product.id"
                      :products="products"
                    >
                    </home-stock-product-component>
                  </td>
                  <td>{{ product.precio }}</td>

                  <td>
                    {{ product.nombreCategoria }}
                  </td>
                  <td>
                    <button
                      type="button"
                      class="btn btn-warning"
                      data-toggle="modal"
                      data-target="#editModal"
                      @click="SetEditProduct(product)"
                    >
                      Editar
                    </button>

                    |
                    <button
                      type="button"
                      class="btn btn-danger"
                      @click="SetDeleteProduct(product)"
                    >
                      Eliminar
                    </button>
                    |

                    <button
                      type="button"
                      class="btn btn-primary"
                      v-on:click="SetProductVariations(product)"
                    >
                      Variaciones
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

    <!-- Modal para crear producto-->
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
              Agregar un nuevo producto.
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
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="">Selecciones una categoria:</label>
                      <select
                        v-model="categorieSelect"
                        class="form-control"
                        id="docente"
                      >
                        <option
                          v-for="(cate, index) in categorias"
                          :key="index"
                          :value="cate.id"
                        >
                          {{ cate.nombre }}
                        </option>
                      </select>
                      <label>Nombre del producto:</label>
                      <input
                        type="text"
                        name=""
                        id=""
                        class="form-control"
                        placeholder="Nueva categoria"
                        v-model="nombre"
                      />

                      <label>Descripcion</label>
                      <input
                        type="text"
                        name=""
                        id=""
                        class="form-control"
                        v-model="descripcion"
                      />
                      <label>Precio:</label>
                      <input
                        type="number"
                        name=""
                        id=""
                        class="form-control"
                        v-model="precio"
                      />
                      <label>Seleccion una imagen:</label>
                      <input
                        type="file"
                        name="image"
                        id=""
                        ref="imageNew"
                        class="form-control"
                        @change="imageSelected"
                      />
                    </div>
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
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
            <button v-on:click="addProduct()" class="btn btn-success">
              Crear nuevo producto
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal para editar producto -->
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
            <h5 class="modal-title" id="exampleModalLabel">Editar Producto:</h5>
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
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <h5>ID Producto #{{ product_edit.id }}</h5>
                      <label for="">Selecciones una categoria:</label>
                      <select
                        v-model="categorieSelectToEdit"
                        class="form-control"
                        id="docente"
                      >
                        <option
                          v-for="(cate, index) in categorias"
                          :key="index"
                          :value="cate.id"
                        >
                          {{ cate.nombre }}
                        </option>
                      </select>
                      <label>Nombre del producto:</label>
                      <input
                        type="text"
                        name=""
                        id=""
                        class="form-control"
                        v-model="product_edit.nombre"
                      />
                      <label>Descripcion</label>
                      <input
                        type="text"
                        name=""
                        id=""
                        class="form-control"
                        v-model="product_edit.descripcion"
                      />
                      <label>precio</label>
                      <input
                        type="number"
                        name=""
                        id=""
                        class="form-control"
                        v-model="product_edit.precio"
                      />
                    </div>
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
              @click="EditProduct()"
            >
              Actualizar cambios
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Lista de variaciones -->
    <div class="row mt-3">
      <div class="col-12">
        <div class="card" v-if="variationModal == 1">
          <div class="card-header">
            <h3 class="card-title">Lista de atributos:</h3>

            <div class="card-tools">
              <button
                type="button"
                class="btn btn-success"
                data-toggle="modal"
                data-target="#variacionPersonalizadaModal"
              >
                <i class="fas fa-plus"></i> Crear Atributo personalizado
              </button>
              <button
                type="button"
                class="btn btn-secondary"
                v-on:click="CerrarModalVariations()"
              >
                <i class="fas fa-times"></i> Cerrar
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Breve descripcion</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(variacion, index) in variaciones" :key="index.id">
                  <td>{{ variacion.nombre }}</td>
                  <td>{{ variacion.description }}</td>
                  <td>
                    <button
                      type="button"
                      class="btn btn-warning"
                      data-toggle="modal"
                      data-target="#editarVariacionPersonalizadaModal"
                      v-on:click="SetEditVariation(variacion)"
                    >
                      Editar
                    </button>
                    <button
                      type="button"
                      class="btn btn-danger"
                      @click="SetDeleteVariation(variacion)"
                    >
                      Eliminar
                    </button>
                    <button
                      type="button"
                      class="btn btn-primary"
                      @click="GetItemsOfVariations(variacion)"
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

    <!-- Lista de items de las variaciones -->

    <div class="row mt-3">
      <div class="col-12">
        <div class="card" v-if="itemsVariationModal == 1">
          <div class="card-header">
            <h2># {{ nombreMostrarLista }}</h2>
            <h3 class="card-title">Lista de Items:</h3>

            <div class="card-tools">
              <button
                type="button"
                class="btn btn-success"
                data-toggle="modal"
                data-target="#crearItemPersonalizadoModal"
              >
                <i class="fas fa-plus"></i> Crear nuevo Item
              </button>

              <button
                type="button"
                class="btn btn-secondary"
                v-on:click="itemsVariationModal = 0"
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
                <tr v-for="(item, index) in items" :key="index.id">
                  <td>{{ item.nombre }}</td>
                  <td>
                    <button
                      type="button"
                      class="btn btn-warning"
                      data-toggle="modal"
                      data-target="#editItemPersonalizadaModal"
                      v-on:click="SetEditItem(item)"
                    >
                      Editar
                    </button>
                    <button
                      type="button"
                      class="btn btn-danger"
                      @click="SetDeleteItem(item)"
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

    <!-- Modal para crear variacion personalizada-->
    <div
      class="modal fade"
      id="variacionPersonalizadaModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              Crear atributo personalizado
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
              <label for="">Nombre:</label>
              <input
                type="text"
                name=""
                id=""
                class="form-control"
                v-model="nombreVariation"
              />
              <label for="">Breve Descripcion:</label>
              <input
                type="text"
                name=""
                id=""
                class="form-control"
                v-model="descriptionVariation"
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
              v-on:click="CreateVariation()"
            >
              Crear nuevo atributo personalizada
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal para editar variacion personalizada-->
    <div
      class="modal fade"
      id="editarVariacionPersonalizadaModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              Editar Variacion Personalizada
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
              <label for="">Nombre:</label>
              <input
                type="text"
                name=""
                id=""
                v-model="variationEdit.nombre"
                class="form-control"
              />
              <label for="">Breve Descripcion</label>
              <input
                type="text"
                name=""
                id=""
                v-model="variationEdit.description"
                class="form-control"
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
              v-on:click="EditVariaton()"
            >
              Actualizar cambios
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal para crear nuevo item de variacion personalizada -->
    <div
      class="modal fade"
      id="crearItemPersonalizadoModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Crear Nuevo Item</h5>
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
                v-model="itemNombre"
                class="form-control"
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
              v-on:click="CreateItem()"
            >
              Crear Item
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal para editar item de la variacion personalizada-->
    <div
      class="modal fade"
      id="editItemPersonalizadaModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Item:</h5>
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
              <label for="">Nombre del item:</label>
              <input
                type="text"
                name=""
                id=""
                class="form-control"
                v-model="itemToEdit.nombre"
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
              v-on:click="EditItem()"
            >
              Actualizar cambios
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Lista de variaciones -->

    <div class="row mt-3">
      <div class="col-12">
        <div class="card" v-if="variacionesModal == 1">
          <div class="card-header">
            <h3 class="card-title">Variaciones</h3>

            <div class="card-tools">
              <!-- Button trigger modal -->
              <button
                type="button"
                class="btn btn-success"
                data-toggle="modal"
                data-target="#createVariacionesModal"
              >
                <i class="fas fa-plus"></i> Agregar Nueva Variacion
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Items</th>
                  <th>Stock</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(
                    variacionDelProducto, index
                  ) in variacionesDelProducto"
                  :key="index.id"
                >
                  <td>{{ variacionDelProducto.id }}</td>

                  <td v-if="variacionesDelProducto">
                    <home-variacion-item-show-component
                      :variacion_id="variacionDelProducto.id"
                    >
                    </home-variacion-item-show-component>
                  </td>
                  <td>
                    {{ variacionDelProducto.stock }} |
                    <button
                      type="button"
                      class="btn btn-warning"
                      data-toggle="modal"
                      data-target="#editStockModal"
                      v-on:click="SetEditStock(variacionDelProducto)"
                    >
                      Editar Stock
                    </button>
                  </td>

                  <td>
                    <button
                      type="button"
                      class="btn btn-danger"
                      @click="SetDeleteVariacion(variacionDelProducto)"
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

    <!-- Modal para crear variaciones!-->
    <div
      class="modal fade"
      id="createVariacionesModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
              v-on:click="SetDeleteVariacionInClose()"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <button
              class="btn btn-success"
              v-on:click="NewVariation()"
              :disabled="btnNewVariationEnable == 1"
            >
              Crear Nueva variacion
            </button>
            <div class="container mt-3" v-if="NewVariationsModal == 1">
              <div class="row">
                <div class="col">
                  <div
                    class="form-group"
                    v-for="(atributo, index) in variaciones"
                    :key="index"
                  >
                    <label for="">{{ atributo.nombre }}</label>
                    <home-items-variaciones-component
                      :atributo_id="atributo.id"
                      @clicked="onClickChild"
                    >
                    </home-items-variaciones-component>
                  </div>
                  <label for="">Stock:</label>
                  <input
                    type="number"
                    name=""
                    id=""
                    min="0"
                    class="form-control"
                    v-model="stockCreateVariacion"
                  />
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
              v-on:click="SetDeleteVariacionInClose()"
            >
              Close
            </button>
            <button
              type="button"
              class="btn btn-success"
              v-on:click="NewVariacionItemsCreate()"
              :disabled="btnSaveVariationEnable == 1"
              data-dismiss="modal"
            >
              Guardar Cambios
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div
      class="modal fade"
      id="editStockModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Stock</h5>
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
            <h4>Editar stock:</h4>
            <div class="form-group">
              <label for="">Stock:</label>
              <input
                type="number"
                name=""
                id=""
                min="0"
                class="form-control"
                v-model="setEditStock.stock"
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
              v-on:click="EditStock()"
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
      user_id: Number,
      products: [],
      endpointCreate: "/cuenta/product/create",
      endpointEdit: "/cuenta/product/edit",
      endpointDelete: "/cuenta/product/delete",
      endpointCreateVariation: "/cuenta/variations/create",
      endpointEditVariation: "/cuenta/variations/edit",
      endpointDeleteVariation: "/cuenta/variations/delete",
      endpointCreateItem: "/cuenta/variations/items/create",
      endpointEditItem: "/cuenta/variations/items/edit",
      endpointDeleteItem: "/cuenta/variations/items/delete",
      endpointCreateVariaciones: "/cuenta/variaciones/create",
      endpointCreateItemVariaciones: "/cuenta/variaciones/items/create",
      endpointDeleteVariacion: "/cuenta/variaciones/delete",
      endpointEditStockVariacion: "/cuenta/variaciones/stock/edit",
      nombre: "",
      descripcion: "",
      precio: "",
      product_edit: [],
      product_delete: [],
      categorias: [],
      categorieSelect: "",
      categorieSelectToEdit: "",
      variationModal: 0,
      productModal: 1,
      variacionesModal: 0,
      itemsVariationModal: 0,
      NewVariationsModal: 0,
      variationProductEdit: [],
      title: "Productos:",
      variaciones: [],
      nombreVariation: "",
      descriptionVariation: "",
      variationEdit: [],
      variation_delete: [],
      items: [],
      nombreMostrarLista: "",
      itemNombre: "",
      variationId: Number,
      itemToEdit: [],
      itemToDelete: [],
      product_id: "",
      variacionesDelProducto: [],
      variationValuesforChild: [],
      newVariation: [],
      btnNewVariationEnable: 0,
      btnSaveVariationEnable: 0,
      variacionToDelete: [],
      stringVariaciones: [],
      stockCreateVariacion: 0,
      setEditStock: [],
      image: null,
      imagePreview: null,
      imagePreviewEdit: null,
      imageEdit: "",
      imagePreviewEdit: null,
      imageEdit: "",
    };
  },

  props: ["user", "tienda_id"],
  mounted() {
    /* this.tiendaGet = JSON.parse(this.tienda); */
    console.log("tienda ID");
    console.log(this.tienda_id);

    axios.get("/private/tienda/" + this.user).then((respuesta) => {
      this.user_id = this.user;
    });

    axios.get("/cuenta/product/" + this.tienda_id).then((respuesta) => {
      console.log(respuesta.data);
      this.products = respuesta.data;
    });

    axios.get("/cuenta/categorie/" + this.tienda_id).then((respuesta) => {
      console.log(respuesta.data);
      this.categorias = respuesta.data;
    });
  },

  methods: {
    imageSelectedEdit(e) {
      this.imageEdit = e.target.files[0];

      let reader = new FileReader();
      reader.readAsDataURL(this.imageEdit);
      reader.onload = (e) => {
        this.imagePreviewEdit = e.target.result;
      };
    },

    imageSelected(e) {
      this.image = e.target.files[0];
      let reader = new FileReader();
      reader.readAsDataURL(this.image);
      reader.onload = (e) => {
        this.imagePreview = e.target.result;
      };
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
        var str = value.nombre;
        var tolower = str.toLowerCase();
      }

      if (
        this.stringVariaciones.some(
          (elem) => elem.variation_id === value.variation_id
        )
      ) {
        console.log("ya esta");
        var index = this.stringVariaciones.findIndex(
          (item) => item.variation_id === value.variation_id
        );
        this.stringVariaciones.splice(index, 1, value);
      } else {
        this.stringVariaciones.push(value);
        var str = value.nombre;
        var tolower = str.toLowerCase();
      }
      console.log(this.stringVariaciones);
    },

    actualizarLista() {
      var simply = "";
      var clear = "";

      axios.get("/cuenta/product/" + this.user).then((respuesta) => {
        simply = JSON.stringify(respuesta.data);
        clear = JSON.parse(simply);
        this.products = clear;
      });
    },

    listarVariaciones() {
      var simply = "";
      var clear = "";

      axios
        .get("/cuenta/product/variations/" + this.variationProductEdit.id)
        .then((respuesta) => {
          simply = JSON.stringify(respuesta.data);
          clear = JSON.parse(simply);
          this.variaciones = clear;
        });
    },

    listarItems() {
      var simply = "";
      var clear = "";

      axios
        .get("/cuenta/product/variations/items/" + this.variationId)
        .then((respuesta) => {
          simply = JSON.stringify(respuesta.data);
          clear = JSON.parse(simply);
          this.items = clear;
        });
    },

    listarVariacionesDelProducto() {
      var simply = "";
      var clear = "";

      axios
        .get("/cuenta/product/variaciones/" + this.product_id)
        .then((respuesta) => {
          simply = JSON.stringify(respuesta.data);
          clear = JSON.parse(simply);
          this.variacionesDelProducto = clear;
        });
    },

    SetEditStock(variacion) {
      this.setEditStock = variacion;
    },

    EditStock() {
      axios({
        method: "POST",
        url: this.endpointEditStockVariacion,
        data: {
          variacion_id: this.setEditStock.id,
          stock: this.setEditStock.stock,
        },
        headers: {
          Accept: "Application/json",
          "Content-Type": "application/json",
        },
      })
        .then((respuesta) => {
          console.log(respuesta);
          toast.fire({
            title: "Stock Actualizado",
            text: "El Stock se ha actualizado con exito!",
            icon: "success",
            confirmButtonText: "Cerrar",
            timer: 3000,
          });
          this.listarVariacionesDelProducto();
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    NewVariacionItemsCreate() {
      var simply = JSON.stringify(this.variationValuesforChild);
      console.log(simply);
      axios({
        method: "POST",
        url: this.endpointCreateItemVariaciones,
        data: {
          items: simply,
          variacion_id: this.newVariation,
          stock: this.stockCreateVariacion,
          product_id: this.product_id,
        },
        headers: {
          Accept: "Application/json",
          "Content-Type": "application/json",
        },
      })
        .then((respuesta) => {
          console.log("=========Respuesta desde laravel===========");
          console.log(respuesta);
          toast.fire({
            title: "Nuevo Item Creado!",
            text: "Se ha creado un nuevo item exitosamente!",
            icon: "success",
            confirmButtonText: "Aceptar",
            timer: 3000,
          });
          this.btnSaveVariationEnable = 1;
          this.btnNewVariationEnable = 0;
          this.NewVariationsModal = 0;
          this.listarVariacionesDelProducto();
          this.variationValuesforChild = [];
          simply = [];
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    NewVariation() {
      axios({
        method: "POST",
        url: this.endpointCreateVariaciones,
        data: {
          product_id: this.product_id,
        },
        headers: {
          Accept: "Application/json",
          "Content-Type": "application/json",
        },
      })
        .then((respuesta) => {
          /* toast.fire({
            title: "Nuevo Item Creado!",
            text: "Se ha creado un nuevo item exitosamente!",
            icon: "success",
            confirmButtonText: "Aceptar",
            timer: 3000,
          }); */
          this.NewVariationsModal = 1;
          this.newVariation = respuesta.data;
          console.log("este es??");
          console.log(this.newVariation);
          this.btnNewVariationEnable = 1;
          this.btnSaveVariationEnable = 0;
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    SetDeleteVariacionInClose() {
      axios({
        method: "POST",
        url: this.endpointDeleteVariacion,
        data: {
          variacion_id: this.newVariation,
        },
        headers: {
          Accept: "Application/json",
          "Content-Type": "application/json",
        },
      })
        .then((respuesta) => {
          console.log(respuesta);
          toast.fire(
            "Variacion Eliminada!",
            "Se ah descartado la variacion.",
            "error"
          );
          this.listarVariacionesDelProducto();
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    SetDeleteVariacion(variacion) {
      this.variacionToDelete = variacion;
      toast
        .fire({
          title: "¿Esta seguro?",
          text: "Esta a punto de eliminar esta Variacion!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          cancelButtonText: "Cancelar",
          confirmButtonText: "SI, quiero eliminarla!",
        })
        .then((result) => {
          if (result.isConfirmed) {
            //
            this.DeleteVariacion();
          }
        });
    },

    DeleteVariacion() {
      axios({
        method: "POST",
        url: this.endpointDeleteVariacion,
        data: {
          variacion_id: this.variacionToDelete.id,
        },
        headers: {
          Accept: "Application/json",
          "Content-Type": "application/json",
        },
      })
        .then((respuesta) => {
          console.log(respuesta);
          toast.fire(
            "Variacion Eliminada!",
            "Se ah eliminado la variacion exitosamente.",
            "success"
          );
          this.listarVariacionesDelProducto();
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    SetDeleteItem(item) {
      this.itemToDelete = item;
      toast
        .fire({
          title: "¿Esta seguro?",
          text: "Esta a punto de eliminar este Item!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          cancelButtonText: "Cancelar",
          confirmButtonText: "SI, quiero eliminarlo!",
        })
        .then((result) => {
          if (result.isConfirmed) {
            //
            this.DeleteItem();
          }
        });
    },

    SetEditItem(item) {
      this.itemToEdit = item;
    },

    DeleteItem() {
      axios({
        method: "POST",
        url: this.endpointDeleteItem,
        data: {
          item_id: this.itemToDelete.id,
        },
        headers: {
          Accept: "Application/json",
          "Content-Type": "application/json",
        },
      })
        .then((respuesta) => {
          console.log(respuesta);
          toast.fire(
            "Item Eliminado!",
            "Se ah eliminado el item exitosamente.",
            "success"
          );
          this.listarItems();
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    EditItem() {
      axios({
        method: "POST",
        url: this.endpointEditItem,
        data: {
          item_id: this.itemToEdit.id,
          item_nombre: this.itemToEdit.nombre,
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
          this.listarItems();
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    CreateItem() {
      axios({
        method: "POST",
        url: this.endpointCreateItem,
        data: {
          variation_id: this.variationId,
          item_nombre: this.itemNombre,
        },
        headers: {
          Accept: "Application/json",
          "Content-Type": "application/json",
        },
      })
        .then((respuesta) => {
          console.log(respuesta);
          toast.fire({
            title: "Nuevo Item Creado!",
            text: "Se ha creado un nuevo item exitosamente!",
            icon: "success",
            confirmButtonText: "Aceptar",
            timer: 3000,
          });
          this.listarItems();
          this.itemNombre = "";
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    GetItemsOfVariations(variacion) {
      axios
        .get("/cuenta/product/variations/items/" + variacion.id)
        .then((respuesta) => {
          this.items = respuesta.data;
          this.itemsVariationModal = 1;
          this.nombreMostrarLista = variacion.nombre;
          this.variationId = variacion.id;
        });
    },

    CreateVariation() {
      axios({
        method: "POST",
        url: this.endpointCreateVariation,
        data: {
          product_id: this.variationProductEdit.id,
          nombre: this.nombreVariation,
          description: this.descriptionVariation,
        },
        headers: {
          Accept: "Application/json",
          "Content-Type": "application/json",
        },
      })
        .then((respuesta) => {
          console.log(respuesta);
          toast.fire({
            title: "Variacion personalizada Creada!",
            text:
              "Se ha creado una nueva variacion personalizada exitosamente!",
            icon: "success",
            confirmButtonText: "Aceptar",
            timer: 3000,
          });
          this.listarVariaciones();
          this.nombreVariation = "";
          this.descriptionVariation = "";
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    SetEditVariation(variation) {
      this.variationEdit = variation;
    },

    EditVariaton() {
      axios({
        method: "POST",
        url: this.endpointEditVariation,
        data: {
          variation_id: this.variationEdit.id,
          variation_nombre: this.variationEdit.nombre,
          variation_description: this.variationEdit.description,
        },
        headers: {
          Accept: "Application/json",
          "Content-Type": "application/json",
        },
      })
        .then((respuesta) => {
          console.log(respuesta);
          toast.fire({
            title: "Variacion Personalizada Actualizada",
            text: "La variacion personalizada se ha actualizado con exito!",
            icon: "success",
            confirmButtonText: "Cerrar",
            timer: 3000,
          });
          this.listarVariaciones();
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    SetDeleteVariation(variation) {
      this.variation_delete = variation;
      toast
        .fire({
          title: "¿Esta seguro?",
          text: "Esta a punto de eliminar una variacion personalizada!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          cancelButtonText: "Cancelar",
          confirmButtonText: "SI, quiero eliminarla!",
        })
        .then((result) => {
          if (result.isConfirmed) {
            //
            this.DeleteVariation();
          }
        });
    },

    DeleteVariation() {
      axios({
        method: "POST",
        url: this.endpointDeleteVariation,
        data: {
          variation_id: this.variation_delete.id,
        },
        headers: {
          Accept: "Application/json",
          "Content-Type": "application/json",
        },
      })
        .then((respuesta) => {
          console.log(respuesta);
          toast.fire(
            "Variacion Personalizada Eliminada!",
            "Se ah eliminado la variacion personalizada exitosamente.",
            "success"
          );
          this.listarVariaciones();
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    CerrarModalVariations() {
      this.variationModal = 0;
      this.productModal = 1;
      this.itemsVariationModal = 0;
      this.variacionesModal = 0;
      this.title = "Productos:";
    },

    SetProductVariations(product) {
      this.variationModal = 1;
      this.productModal = 0;
      this.variationProductEdit = product;
      this.variacionesModal = 1;
      this.title =
        "Variaciones del producto: " + this.variationProductEdit.nombre;
      this.listarVariaciones();
      this.product_id = product.id;
      this.listarVariacionesDelProducto();
    },

    getNombreCate(cate_id) {
      axios.get("/cuenta/product/categorie/" + cate_id).then((respuesta) => {
        this.nombresCategoria = respuesta.data;
      });
    },

    addProduct() {
      console.log("addCategorie");

      let data = new FormData();
      data.append("tienda_id", this.tienda_id);
      data.append("nombre", this.nombre);
      data.append("descripcion", this.descripcion);
      data.append("image", this.image);
      data.append("categoria_id", this.categorieSelect);
      data.append("precio", this.precio);

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
            title: "Producto Creado!",
            text: "Se ha creado un nuevo producto exitosamente!",
            icon: "success",
            confirmButtonText: "Aceptar",
            timer: 3000,
          });
          this.actualizarLista();
          this.nombre = "";
          this.descripcion = "";
          this.precio = "";
          this.categorieSelect = [];
          this.imagePreview = "";
          this.$refs.imageNew.value = ""; //estables una referencia en el input file, y este codigo lo busca y lo vacia!
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    SetEditProduct(product) {
      this.product_edit = product;
      this.categorieSelectToEdit = product.categoria_id;
      this.imagePreviewEdit = product.img;
    },

    EditProduct() {
      let data = new FormData();
      data.append("tienda_id", this.tienda_id);
      data.append("product_id", this.product_edit.id);
      data.append("product_categorie_id", this.categorieSelectToEdit);
      data.append("product_nombre", this.product_edit.nombre);
      data.append("product_descripcion", this.product_edit.descripcion);
      data.append("image", this.imageEdit);
      data.append("product_precio", this.product_edit.precio);
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

    SetDeleteProduct(product) {
      this.product_delete = product;
      toast
        .fire({
          title: "¿Esta seguro?",
          text: "Esta a punto de eliminar esté producto!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          cancelButtonText: "Cancelar",
          confirmButtonText: "SI, quiero eliminarlo!",
        })
        .then((result) => {
          if (result.isConfirmed) {
            //
            this.DeleteProduct();
          }
        });
    },

    DeleteProduct() {
      axios({
        method: "POST",
        url: this.endpointDelete,
        data: {
          product_id: this.product_delete.id,
        },
        headers: {
          Accept: "Application/json",
          "Content-Type": "application/json",
        },
      })
        .then((respuesta) => {
          console.log(respuesta);
          toast.fire(
            "Producto Eliminado!",
            "Se ah eliminado el producto exitosamente.",
            "success"
          );
          this.actualizarLista();
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>
https://www.linuxmint.com/start/tricia/