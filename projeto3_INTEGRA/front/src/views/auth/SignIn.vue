<script>
import ButtonComponent from '../../components/forms/ButtonComponent.vue';
import InputComponent from '../../components/forms/InputComponent.vue';
import LinkComponent from '../../components/forms/LinkComponent.vue';
import TitleComponent from '../../components/forms/TitleComponent.vue';
import CenteredCard from '../../components/layout/CenteredCard.vue';

export default {
    components: {
        ButtonComponent,
        InputComponent,
        LinkComponent,
        TitleComponent,
        CenteredCard
    },
    data() {
        return {
            username: null,
            password: null,
        }
    },
    methods: {
        teste: function() {
            console.log(this.username + ' ' + this.password);
        }
    }
}
</script>

<template>
    <main class="w-full">
        <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
            <a href="/"
                class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white">
                <img src="../../assets/logo.svg" class="mr-4 h-11"
                    alt="CastorSoft Logo">
                <span>CastorSoft</span>
            </a>
            <!-- Card -->
            <CenteredCard>
                <TitleComponent title="Entre na plataforma" />
                <form class="mt-8 space-y-6" action="">
                    <InputComponent type="email" id="email" label="Seu e-mail" placeholder="email@exemplo.com" required v-model:value="username" />
                    <InputComponent type="password" id="password" label="Sua senha" placeholder="********" required v-model:value="password" />
                    <div class="flex items-start">
                        <InputComponent type="checkbox" id="remember" label="Lembrar-me" required />
                        <LinkComponent name="auth.forgot-password" />
                    </div>
                    <ButtonComponent type="button" text="Login" @button-click="teste" />
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Não é registrado? <LinkComponent name="auth.sign-up" label="Crie uma conta" />
                    </div>
                </form>
            </CenteredCard>
        </div>

    </main>
</template>