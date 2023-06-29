import {
    findIndex
} from "lodash";

const state = {

    cart: [],

    count: 0,
};


const getters = {

    cart: state => state.cart,

    count: state => state.count,

};


const actions = {
    addToCart: (context, payload) => {
        context.commit("addProductInCart", payload)
    },

    ClearCart: (context) => {
        context.commit("clearCart")
    }
};


const mutations = {
    increment() {
        state.count++
    },

    addProductInCart(state, payload) {

        var item = payload;
        var ss = JSON.stringify(item);
        var nobj = JSON.parse(ss);

        nobj = {
            ...nobj,
        }

        if (state.cart.length > 0) {
            var filter = state.cart.filter(i => i.id === nobj.id)
            if (filter) {
                var filter2 = filter.filter((f) => {
                    var test = f.variaciones.every((v, j) => {
                        return v === nobj.variaciones[j]
                    })
                    return test
                })
                console.log(filter2)
                if (filter2.length > 0) {
                    console.log("ya esta")
                } else {
                    state.cart.push(nobj)
                }
            }
        } else {
            state.cart.push(nobj)
        }
    },

    deleteProductInCart: (state, payload) => {
        const i = state.cart.map(item => item.id).indexOf(payload.id);
        state.cart.splice(i, 1);
        state.count--
    },

    clearCart: (state) => {
        state.cart.splice(0, state.cart.length);
    }
};


export default {
    state,
    getters,
    actions,
    mutations
}
