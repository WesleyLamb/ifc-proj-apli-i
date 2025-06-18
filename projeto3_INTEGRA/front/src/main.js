import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import './style.css'
// import './input.css'
import App from './App.vue'
import Dashboard from './views/Dashboard.vue'

const routes = [
    { path: '/', component: Dashboard}
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

createApp(App).use(router).mount('#app')
