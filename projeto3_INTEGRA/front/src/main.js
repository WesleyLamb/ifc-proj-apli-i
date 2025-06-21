import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import './style.css'
import './input.css'
import App from './App.vue'
import Dashboard from './views/Dashboard.vue'
import SignIn from './views/auth/SignIn.vue'
import SignUp from './views/auth/SignUp.vue';
import ForgotPassword from './views/auth/ForgotPassword.vue';
import AuthService from './services/AuthService';
import UserApplications from './views/user/Applications.vue';
import AdminApplications from './views/admin/Applications.vue';

const routes = [
    { path: '/', component: Dashboard, name: 'dashboard'},
    { path: '/auth/sign-in', component: SignIn, name: 'auth.sign-in' },
    { path: '/auth/sign-up', component: SignUp, name: 'auth.sign-up'},
    { path: '/auth/forgot-password', component: ForgotPassword, name: 'auth.forgot-password' },
    { path: '/apps', component: UserApplications, name: 'user.apps'},
    { path: '/admin', beforeEnter() {

        }, children: [
            { path: 'apps', component: AdminApplications, name: 'admin.apps' }
        ]
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach(async (to, from) => {
    // Se não é uma das rotas que não necessitam de autenticação
    if (!['auth.sign-in', 'auth.sign-up', 'auth.forgot-password', 'auth.register'].includes(to.name)) {
        // Se a sessão expirou, tenta reautenticar
        if (!AuthService.isAuthenticated()) {
            await AuthService.refresh();
        }
        // Se não conseguiu, é porque o refresh token expirou ou nem tem
        if (!AuthService.isAuthenticated()) {
            return { name: 'auth.sign-in' }
        }
    }
})

createApp(App).use(router).mount('#app')
