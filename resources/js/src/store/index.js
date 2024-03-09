import { createStore } from 'vuex';
import Auth    from "@/store/modules/Auth";
import Profile from '@/store/modules/Profile.js';
import Dashboard from '@/store/modules/Dashboard.js';

const store = createStore({
    state: {
        url: import.meta.env.VITE_APP_URL,
    },
    modules: {
        Auth,
        Profile,
        Dashboard,
    }
});

export default store;
