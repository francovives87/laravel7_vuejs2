import axios from 'axios';

const state = {
    data:''
};


const getters = {
    line : state => state.data
};


const actions = {
    update({commit}){

        commit('setLineText','Nuevo contenido state de vuex module');
    }
};


const mutations = {
    setLineText:(state,text) => (state.data =  text)
};


export default {
    state,
    getters,
    actions,
    mutations
}