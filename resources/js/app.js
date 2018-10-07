import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from './views/Home'
import App from './views/App';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routers: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
