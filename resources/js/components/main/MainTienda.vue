<template>
  <div>
    <tienda-componets-slider-component></tienda-componets-slider-component>

    <!-- {{ $route.params.name }} -->
    <tienda-categories-component></tienda-categories-component>
  </div>
</template>

<script>
export default {
  props: [""],
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
