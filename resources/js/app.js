import { createApp } from 'vue';
import App from '@/App.vue';
import Router from '@/router';
import Store from '@/store';
import componenets from '@/components/UI';

const app = createApp(App);

componenets.forEach(componenet => {
    app.component(componenet.name, componenet);
});

app
.use(Router)
.use(Store)
.mount('#app');
