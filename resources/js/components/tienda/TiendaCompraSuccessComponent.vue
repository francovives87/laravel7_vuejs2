<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Muchas Gracias!</div>

          <div class="card-body">Hemos recibibo su pedido exitosamente!</div>

          <router-link :to="{ name: 'tiendaHome' }" class="btn btn-primary">
            Volver a la tienda.
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: [""],
  mounted() {},
};
</script>
