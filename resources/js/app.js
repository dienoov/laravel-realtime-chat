require('./bootstrap');

import {createApp} from 'vue';
import {createRouter, createWebHistory} from 'vue-router';

import Login from './components/Login';
import Messages from './components/Messages';

const router = createRouter({
    history: createWebHistory(),
    routes: [{
        path: '/',
        component: Messages,
    }, {
        path: '/login',
        component: Login,
    }],
});

const app = createApp({});

app.use(router);

app.mount('#app');
