<template>
    <div class="d-flex flex-grow-1">
    <form class="mr-2 my-auto w-100 d-inline-block order-1">
            <div class="input-group">
                <input type="text" class="form-control border border-right-0" placeholder="Search...">
                <span class="input-group-append">
                    <button class="btn btn-outline-dark border border-left-0" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
    </div>
</template>

<script>
    export default {

        props:['categoriesTienda'],
        mounted() {
            console.log('Component mounted.')
            console.log(this.categoriesTienda)
        }
    }
</script>
