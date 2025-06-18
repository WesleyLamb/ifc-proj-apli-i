import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import './style.css'
import './input.css'
import App from './App.vue'
import Dashboard from './views/Dashboard.vue'
import Login from './views/Login.vue';

const routes = [
    { path: '/', component: Dashboard},
    { path: '/login', component: Login, name: 'login'},
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

createApp(App).use(router).mount('#app')
