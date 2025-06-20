import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import './style.css'
import './input.css'
import App from './App.vue'
import Dashboard from './views/Dashboard.vue'
import SignIn from './views/auth/SignIn.vue'
import SignUp from './views/auth/SignUp.vue';
import ForgotPassword from './views/auth/ForgotPassword.vue';

const routes = [
    { path: '/', component: Dashboard },
    { path: '/auth/sign-in', component: SignIn, name: 'auth.sign-in' },
    { path: '/auth/sign-up', component: SignUp, name: 'auth.sign-up'},
    { path: '/auth/forgot-password', component: ForgotPassword, name: 'auth.forgot-password' }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

createApp(App).use(router).mount('#app')
