<template>
  <section class="parallex py-5" :style="{'background-image':'linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url(/storage/clothing-store-984396_1280.jpg)'}">
    <div class="container py-5 text-white text-center">
      <div class="row py-3">
        <div class="col-lg-9 mx-auto">
          <h1>Women's lookbook</h1>
          <p class="py-3">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum
            distinctio rem ratione, assumenda quis sequi facilis recusandae quae
            saepe, optio ab quaerat adipisci earum expedita quia dolorem quasi?
            Saepe, autem.
          </p>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  },
};
</script>

<style>
.parallex {
    background-attachment: fixed;
    background-size: 100% 100%;
    width: 100%;
    
}

.parallex h1 {
    font-size: 55px;
    font-weight: 700;
}

.parallex p {
    font-size: 22px;
}
</style>


