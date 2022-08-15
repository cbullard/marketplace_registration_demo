import Vue from "vue";
import Vuex from "vuex";
import axios from 'axios';
Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        step:1,
        dropDownText: {},
        formData: {}
    },
    mutations: {
        setStep(state, payload) {
            state.step = +payload;
        },
        setDropDowns(state, payload) {
            state.dropDownText = payload;
        }
    
    },
    modules: {},
    actions: {
        setStep(state, stp) {
            state.commit("setStep", stp);
        },
        setDropDowns(state) {
            axios.get('api/sellers/get-drop-downs')
            .then(response => {
                if(response.status === 200) {      
                  for (const property in response.data) {
                    // Sort in ascending order
                    response.data[property].sort(function (a, b) {
                      return a.order - b.order;
                    });            
                  }
                  state.commit('setDropDowns', response.data)
                }
              })
              .catch((error) => {
                console.error('ERROR', error)
              });            
        },

    },
    getters: {
        getStep(state) {
            return state.step;
        },
        getDropDowns(state) {
            return state.dropDownText;
        }
    },
})