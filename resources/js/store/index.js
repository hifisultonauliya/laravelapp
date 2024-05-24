// resources/js/store/index.js
import axios from 'axios';
import lodash from 'lodash';
import Vue from 'vue';
import VueLodash from 'vue-lodash';
import Vuex from 'vuex';
import createPersistedState from 'vuex-persistedstate';

Vue.use(Vuex);
Vue.use(VueLodash, { lodash: lodash });

// Utility function to group and format data
function groupAndFormat(list, key) {
    return lodash.chain(list)
        .groupBy(key)
        .map((items, k) => ({
            code: k,
            text: k,
            qty: items.length,
        }))
        .value();
}

export default new Vuex.Store({
    state: {
        masters: [],
        filters: {
            productType: null,
            size: null,
            grade: null,
            connection: null,
        }
    },
    mutations: {
        SET_MASTER(state, val) {
            state.masters = val;
        },
        SET_FILTER(state, val) {
            state.filters = {
                productType: val.productType,
                size: val.size,
                grade: val.grade,
                connection: val.connection,
            };
        },
    },
    actions: {
        fetchMasters({ commit }) {
            axios.get('/api/masterproduct')
                .then(response => {
                    commit('SET_MASTER', response.data);
                })
                .catch(error => {
                    console.error("There was an error fetching the masters:", error);
                });
        },
        setFilters({ commit }, filterData) {
            commit('SET_FILTER', filterData);
        }
    },
    getters: {
        allMasters: state => state.masters,
        getFilters: state => state.filters,
        filteredMasters: state => {
            return state.masters.filter(master => {
                return (!state.filters.productType || master.productType === state.filters.productType) &&
                       (!state.filters.size || master.sizeDesc === state.filters.size) &&
                       (!state.filters.grade || master.grade === state.filters.grade) &&
                       (!state.filters.connection || master.connection === state.filters.connection);
            });
        },
        masterProductType: (state, getters) => groupAndFormat(getters.filteredMasters, 'productType'),
        masterSize: (state, getters) => groupAndFormat(getters.filteredMasters, 'sizeDesc'),
        masterConnection: (state, getters) => groupAndFormat(getters.filteredMasters, 'connection'),
        masterGrade: (state, getters) => groupAndFormat(getters.filteredMasters, 'grade')
    },
    plugins: [createPersistedState()]
});
