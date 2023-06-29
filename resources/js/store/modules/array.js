import axios from 'axios';

const state = {
    title: "hola que tal che",
    productsincarts: ["array1","array2"],
    productState: null,
};


const getters = {
    title: state => state.title,

    productsincarts: state => state.productsincarts
};


const actions = {
  
};


const mutations = {
   
};


export default {
    state,
    getters,
    actions,
    mutations
}