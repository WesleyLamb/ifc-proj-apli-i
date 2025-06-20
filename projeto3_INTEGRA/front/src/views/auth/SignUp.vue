<script>
import ButtonComponent from '../../components/forms/ButtonComponent.vue';
import InputComponent from '../../components/forms/InputComponent.vue';
import LinkComponent from '../../components/forms/LinkComponent.vue';

export default {
    components: {
        ButtonComponent,
        InputComponent,
        LinkComponent,
    }
}
</script>

<template>
    <main class="w-full">
        <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
            <a href="https://flowbite-admin-dashboard.vercel.app/"
                class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white">
                <img src="../assets/logo.svg" class="mr-4 h-11"
                    alt="FlowBite Logo">
                <span>CastorSoft</span>
            </a>
            <!-- Card -->
            <div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Entre na plataforma
                </h2>
                <form class="mt-8 space-y-6" action="#">
                    <InputComponent type="email" id="email" label="Seu e-mail" placeholder="email@exemplo.com" required />
                    <InputComponent type="password" id="password" label="Sua senha" placeholder="********" required />
                    <div class="flex items-start">
                        <InputComponent type="checkbox" id="remember" label="Lembrar-me" required />

                    </div>
                    <ButtonComponent button-type="submit" text="Login"/>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Não é registrado? <LinkComponent name="auth.sign-up" label="Crie uma conta" />
                    </div>
                </form>
            </div>
        </div>

    </main>
</template>