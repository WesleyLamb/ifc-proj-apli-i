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
            name: null,
            email: null,
            password: null,
            password_confirmation: null,
            error_message: null
        }
    },
    methods: {
        register() {
            AuthService.register({name: this.name, email: this.email, password: this.password, password_confirmation: this.password_confirmation}).then((response) => {
                this.$router.push({path: '/'});
            }).catch((error) => {
                console.log('erro: ' + error);
                this.error_message = error.response.data.message
            });
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
                <TitleComponent title="Cadastro de usuário" />
                <Alert v-if="error_message != null" role="alert" title="Erro ao autenticar" :message="error_message" />
                <form class="mt-8 space-y-6" action="">
                    <InputComponent type="text" id="name" label="Seu nome" placeholder="João da Silva" required v-model:value="name" />
                    <InputComponent type="email" id="email" label="Seu e-mail" placeholder="email@exemplo.com" required v-model:value="email" />
                    <InputComponent type="password" id="password" label="Sua senha" placeholder="••••••••" required v-model:value="password" />
                    <InputComponent type="password" id="password_confirmation" label="Confirmação da senha" placeholder="••••••••" required v-model:value="password_confirmation" />

                    <ButtonComponent type="button" text="Cadastrar" @button-click="this.error_message = null; this.register()" />
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Já possui uma conta? <LinkComponent :to="{name: 'auth.sign-in'}" label="Entre agora mesmo" />
                    </div>
                </form>
            </CenteredCard>
        </div>

    </main>
</template>