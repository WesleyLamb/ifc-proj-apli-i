<script>
import ButtonComponent from '@/components/forms/ButtonComponent.vue';
import InputComponent from '@/components/forms/InputComponent.vue';
import LinkComponent from '@/components/forms/LinkComponent.vue';
import TitleComponent from '@/components/forms/TitleComponent.vue';
import Alert from '@/components/layout/Alert.vue';
import CenteredCard from '@/components/layout/CenteredCard.vue';
import AuthService from '@/services/AuthService';

export default {
    components: {
        ButtonComponent,
        InputComponent,
        LinkComponent,
        TitleComponent,
        CenteredCard,
        Alert
    },
    data() {
        return {
            username: null,
            password: null,
            remember_me: null,
            error_message: null
        }
    },
    methods: {
        attemptLogin() {
            AuthService.login(this.username, this.password).then((response) => {
                this.$router.push({path: '/'});
            }).catch((error) => {
                console.log('erro: ' + error);
                this.error_message = error.response.data.message
            })
        }
    }
}
</script>

<template>
    <main class="w-full">
        <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
            <a href="/"
                class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white">
                <img src="@/assets/logo.svg" class="mr-4 h-11"
                    alt="PGS Logo">
                <span>PGS</span>
            </a>
            <!-- Card -->
            <CenteredCard>
                <TitleComponent title="Entre na plataforma" />
                <Alert v-if="error_message != null" role="alert" title="Erro ao autenticar" :message="error_message" />
                <form class="mt-8 space-y-6" action="">
                    <InputComponent type="email" id="email" label="Seu e-mail" placeholder="email@exemplo.com" required v-model:value="username" />
                    <InputComponent type="password" id="password" label="Sua senha" placeholder="••••••••" required v-model:value="password" />
                    <ButtonComponent type="button" text="Login" @button-click="this.error_message = null; this.attemptLogin()" />
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Não é registrado? <LinkComponent :to="{name: 'auth.sign-up'}" label="Crie uma conta" />
                    </div>
                </form>
            </CenteredCard>
        </div>

    </main>
</template>