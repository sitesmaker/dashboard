import axios from 'axios';
import {
    SET_PROFILE_DATA,
    SET_USER_DATA
} from '@/store/mutation-types.js';

export default {
    namespaced: true,
    state: {
        userData: null,
        profileData: null,
    },
    getters: {
        getProfileData(state) {
            return state.profileData;
        }
    },
    mutations: {
        [SET_USER_DATA](state, payload) {
            state.userData = payload;
        },
        [SET_PROFILE_DATA](state, payload) {
            state.profileData = payload;
        }
    },
    actions: {
        async fetchUserData(context) {
            let userData = await axios.post(`${context.rootState.url}/api/auth/me`, null, {
                headers: { Authorization: `Bearer ${localStorage.getItem('access_token')}`}
            });
            userData = userData.data;

            context.commit('SET_USER_DATA', userData);

            await context.dispatch('fetchProfileData');
        },
        async fetchProfileData(context) {
            let profileData,
                userId;
            if(context.state.userData) {
                userId = context.state.userData.id;
                profileData = await axios.post(`${context.rootState.url}/api/auth/profile`, {'user_id': userId}, {
                    headers: { Authorization: `Bearer ${localStorage.getItem('access_token')}`}
                });

                profileData = profileData.data;

                context.commit('SET_PROFILE_DATA', profileData);
            }
        },
        async fetchUpload(context, payload) {
            const formData = new FormData();

            formData.append('avatar', payload.avatar);
            formData.append('id', payload.id);
            const upload = await axios.post(`${context.rootState.url}/api/upload`, formData, {
                headers: { Authorization: `Bearer ${localStorage.getItem('access_token')}`}
            });
        },
    }
}
