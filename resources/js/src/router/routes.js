import Home    from '@/pages/Home.vue';
import Login   from '@/pages/Login.vue';
import Profile      from '@/pages/Profile.vue';
import Registration from '@/pages/Registration.vue';

import axios from 'axios';
import store from  '@/store';

const routes = [
    {
        path: '/',
        component: Home
    },
    {
        path: '/registration',
        component: Registration,
    },
    {
        path: '/login',
        component: Login,
        beforeEnter: (to, from, next) => {
            axios.post(`${store.state.url}/api/auth/me`, null, {
                headers: { Authorization: `Bearer ${localStorage.getItem('access_token')}`}
            }).then((res) => {
                next({
                    path: '/profile',
                })
            }).catch((err) => {
                next()
            })
        },
    },
    {
        path: '/profile',
        component: Profile,
        beforeEnter: (to, from, next) => {
            axios.post(`${store.state.url}/api/auth/me`, null, {
                headers: { Authorization: `Bearer ${localStorage.getItem('access_token')}`}
            }).then((res) => {
                if(res.data) {
                    next()
                }
            }).catch((err) => {
                next({
                    path: '/login',
                })
            })
        },
    }
]

export default routes;
