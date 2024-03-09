import axios from 'axios';
import {
    SET_STATUS_LIST
} from '@/store/mutation-types.js';

export default {
    namespaced: true,
    state: {
        statusList: [],
    },
    getters: {
        getStatusList(state) {
            return state.statusList;
        },
    },
    mutations: {
        [SET_STATUS_LIST](state, payload) {
            state.statusList = payload;
        },
    },
    actions: {
        /*** Начало - обращения к основной задаче ***/
        async fetchMainTaskList(context) {
            let fetchData = await axios.post(`${context.rootState.url}/api/dashboard/read-status`, null, {
                headers: { Authorization: `Bearer ${localStorage.getItem('access_token')}`}
            });

            fetchData = fetchData.data;

            context.commit('SET_STATUS_LIST', fetchData);
        },
        async fetchCreateMainTask(context, title) {
            let fetchData = await axios.post(`${context.rootState.url}/api/dashboard/create-status`, {title: title}, {
                headers: { Authorization: `Bearer ${localStorage.getItem('access_token')}`},
            });

            await context.dispatch('fetchMainTaskList');
        },
        async fetchDeleteMainTask(context, id) {
            let fetchData = await axios.delete(`${context.rootState.url}/api/dashboard/delete-status/${id}`, null, {
                headers: { Authorization: `Bearer ${localStorage.getItem('access_token')}`},
            });

            await context.dispatch('fetchMainTaskList');
        },
        async fetchUpdateMainTask(context, {id, title}) {
            let fetchData = await axios.put(`${context.rootState.url}/api/dashboard/update-status/${id}`, {title: title}, {
                headers: { Authorization: `Bearer ${localStorage.getItem('access_token')}`},
            });

            await context.dispatch('fetchMainTaskList');
        },
        /*** Конец - обращения к основной задаче ***/
        /*** Начало - обращения к дочерним задачам ***/
        async fetchTaskList(context, id) {
            let fetchData = await axios.post(`${context.rootState.url}/api/dashboard/read/${id}`, null, {
                headers: { Authorization: `Bearer ${localStorage.getItem('access_token')}`}
            });

            fetchData = fetchData.data;

            return fetchData;
        },
        async fetchCreateTask(context, {title, text, status_id}) {
            let fetchData = await axios.post(`${context.rootState.url}/api/dashboard/create`, {
                title: title,
                text: text,
                status_id: status_id,
            }, {
                headers: { Authorization: `Bearer ${localStorage.getItem('access_token')}`}
            });

            await context.dispatch('fetchTaskList', status_id);
        },
        async fetchDeleteTask(context, id) {
            let fetchData = await axios.delete(`${context.rootState.url}/api/dashboard/delete/${id}`, null, {
                headers: { Authorization: `Bearer ${localStorage.getItem('access_token')}`},
            });

            await context.dispatch('fetchTaskList', id);
        },
        async fetchUpdateTask(context, {id, title, text}) {
            let fetchData = await axios.put(`${context.rootState.url}/api/dashboard/update/${id}`, {
                title: title,
                text: text
            }, {
                headers: { Authorization: `Bearer ${localStorage.getItem('access_token')}`},
            });

            // await context.dispatch('fetchTaskList', id);
        },
        /*** Конец - обращения к дочерним задачам ***/
    }
}
