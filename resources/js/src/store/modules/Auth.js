import {
    SET_ACCESS_TOKEN,
    DELETE_ACCESS_TOKEN,
} from '@/store/mutation-types.js';

export default {
    namespaced: true,
    state: {
        accessToken: localStorage.getItem('access_token'),
    },
    getters: {
        getAccessToken(state) {
            return state.accessToken;
        }
    },
    mutations: {
        [SET_ACCESS_TOKEN](state, payload) {
            state.accessToken = payload;
        },
        [DELETE_ACCESS_TOKEN](state) {
            state.accessToken = null;
        }
    }
}
