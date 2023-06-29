/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./mapa');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import store from './store';
import LoadScript from 'vue-plugin-load-script';
import VueCarousel from 'vue-carousel';

//Including sweet alert
import swal from 'sweetalert2'
window.swal = swal

const toast = swal.mixin({

});
window.toast = toast;

Vue.use(VueRouter)
Vue.use(LoadScript);
Vue.use(VueCarousel);

//VueRouter





//Rutas Home
const routes = [{
    name: 'home',
    path: '/cuenta/home',
    component: require('./components/home/HomeComponent.vue').default,
    props: true
},
{
    path: '/cuenta/home/categorie',
    name: 'categorie',
    component: require('./components/home/CategorieComponent.vue').default,
    props: true
},
{
    path: '/cuenta/home/product',
    name: 'homeProduct',
    component: require('./components/home/ProductComponent.vue').default,
    props: true
},

{
    path: '/cuenta/home/variation',
    name: 'homeVariation',
    component: require('./components/home/HomeVariationsComponent.vue').default,
    props: true
},

{
    path: '/cuenta/home/pedidos',
    name: 'homePedidos',
    component: require('./components/home/HomePedidosComponent.vue').default,
    props: true
},

//Main Pagina principal de la app

{
    path: '/',
    name: 'mainInicio',
    component: require('./components/main/MainInicio.vue').default,
    props: true
},


//Rutas Tienda

{
    path: '/:name',
    name: 'tiendaHome',
    component: require('./components/main/MainTienda.vue').default,
    props: true
},

{
    path: '/:name/cart',
    name: 'cartHome',
    component: require('./components/tienda/TiendaCartComponent.vue').default,
    props: true
},

{
    path: '/:name/cart/checkout',
    name: 'checkout',
    component: require('./components/tienda/TiendaCheckoutComponent.vue').default,
    props: true
},

{
    path: '/:name/detail',
    name: 'productDetail',
    component: require('./components/tienda/TiendaDetailComponent.vue').default,
    props: true
},

{
    path: '/:name/success',
    name: 'compraSuccess',
    component: require('./components/tienda/TiendaCompraSuccessComponent.vue').default,
    props: true
},


]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})






/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('cartshow-component', require('./components/CartShowComponent.vue').default);
Vue.component('showcategories-component', require('./components/ShowCategoriesComponent.vue').default);
Vue.component('showproducts-component', require('./components/ShowProductsComponent.vue').default);
Vue.component('addtocart-component', require('./components/AddToCartComponent.vue').default);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('variation-component', require('./components/VariationComponent.vue').default);

//Home
Vue.component('createcategorie-component', require('./components/home/CategorieComponent.vue').default);
Vue.component('home-component', require('./components/home/HomeComponent.vue').default);
Vue.component('home-product-component', require('./components/home/ProductComponent.vue').default);
Vue.component('home-variation-component', require('./components/home/HomeVariationsComponent.vue').default);
Vue.component('home-items-variaciones-component', require('./components/home/HomeItemsVariaciones.vue').default);
Vue.component('home-variacion-item-show-component', require('./components/home/HomeVariacionItemsShow.vue').default);
Vue.component('home-type-product-component', require('./components/home/HomeTypeProductComponent.vue').default);
Vue.component('home-stock-product-component', require('./components/home/HomeStockProductComponent.vue').default);
Vue.component('home-pedidos-component', require('./components/home/HomePedidosComponent.vue').default);



//Tienda
Vue.component('tienda-home-component', require('./components/tienda/TiendaHomeComponent.vue').default);
Vue.component('tienda-cart-component', require('./components/tienda/TiendaCartComponent.vue').default);
Vue.component('tienda-categories-component', require('./components/tienda/TiendaCategoriesComponent.vue').default);
Vue.component('tienda-product-component', require('./components/tienda/TiendaProductComponent.vue').default);
Vue.component('tienda-variation-component', require('./components/tienda/TiendaVariationComponent.vue').default);
Vue.component('tienda-addcart-component', require('./components/tienda/TiendaAddCartComponent.vue').default);
Vue.component('tienda-detail-component', require('./components/tienda/TiendaDetailComponent.vue').default);
Vue.component('tienda-checkout-component', require('./components/tienda/TiendaCheckoutComponent.vue').default);
Vue.component('tienda-addcart-detail-component', require('./components/tienda/TiendaAddCartDetailComponent.vue').default);
Vue.component('tienda-compra-success-component', require('./components/tienda/TiendaCompraSuccessComponent.vue').default);
Vue.component('tienda-search-bar-component', require('./components/tienda/TiendaSearchBarComponent.vue').default);


//Main

Vue.component('main-tiendas-nuevas-component', require('./components/main/MainTiendasNuevasComponent.vue').default);



//Tienda Components
Vue.component('tienda-componets-slider-component', require('./components/tiendaComponents/SliderComponent.vue').default);
Vue.component('tienda-componets-header-component', require('./components/tiendaComponents/HeaderComponent.vue').default);

















/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store,
    router
});
