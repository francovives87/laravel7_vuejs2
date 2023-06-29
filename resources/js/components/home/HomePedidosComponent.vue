<template>
  <div class="container">
    <div class="row mt-3">
      <div class="col">
        <h4><i class="fas fa-shopping-cart"></i> Pedidos</h4>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista de Pedidos</h3>

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
                  <th>#ID</th>
                  <th>A Nombre de</th>
                  <th>Metodo de pago</th>
                  <th>Total $</th>
                  <th>Fecha</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(orden,index) in ordenes" :key="index.id">
                  <td>{{orden.id}}</td>
                  <td>{{orden.nombre}}</td>
                  <td>{{orden.metodo_pago}}</td>
                  <td>{{orden.total}}</td>
                  <td>{{orden.created_at}}</td>
                  <td></td>
                  <td>
                      <button class="btn btn-primary">Ver detalles</button>
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
  </div>
</template>

<script>
export default {
  props: ["tienda_id"],
  data() {
    return {
      endpointListarOrdenes: "/cuenta/pedidos/",
      ordenes: [],
    };
  },
  mounted() {
    axios.get(this.endpointListarOrdenes + this.tienda_id).then((respuesta) => {
      console.log(respuesta.data);
      this.ordenes = respuesta.data;
    });
  },
};
</script>
