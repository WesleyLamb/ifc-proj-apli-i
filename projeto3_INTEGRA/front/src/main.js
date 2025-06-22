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
import EstablishmentRegister from './views/user/establishment/Register.vue';
import UserEstablishmentService from './services/UserEstablishmentService';

const routes = [
    { path: '/', component: Dashboard, name: 'dashboard'},
    { path: '/auth/sign-in', component: SignIn, name: 'auth.sign-in' },
    { path: '/auth/sign-up', component: SignUp, name: 'auth.sign-up'},
    { path: '/auth/forgot-password', component: ForgotPassword, name: 'auth.forgot-password' },
    { path: '/applications', component: UserApplications, name: 'user.applications'},
    { path: '/establishments/register', component: EstablishmentRegister, name: 'user.establishments.register'},
    { path: '/admin', children: [
            { path: 'applications', component: AdminApplications, name: 'admin.applications' }
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
        try {
            // Se a sessão expirou, tenta reautenticar
            if (!AuthService.isAuthenticated()) {
                const response = await AuthService.refresh();
            }
        } catch (error) {
            // Se der cucaracha na reautenticação, volta pro login
            return { name: 'auth.sign-in'};
        }
        if (!['user.establishments.register'].includes(to.name)) {
            const response = await AuthService.getAuthenticatedUser();
            const user = response.data.data;

            if (!user.roles.includes('admin') && !UserEstablishmentService.getDefaultEstablishmentId()) {
                let response = await UserEstablishmentService.getEstablishments();
                if (response.data.data.length == 0) {
                    return { name: 'user.establishments.register' };
                } else {
                    UserEstablishmentService.setSelectedEstablishment(response.data.data[0]);
                }
            }
        }
    }
})

createApp(App).use(router).mount('#app')
