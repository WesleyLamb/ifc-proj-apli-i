<script>
import { onMounted } from 'vue';
import { initFlowbite } from 'flowbite';
import { RouterView } from 'vue-router';
import MenuLateral from './components/MenuLateral.vue';
import NavBar from './components/NavBar.vue';

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})
export default {
    components: {
        MenuLateral,
        NavBar,
    }
}
</script>

<template>
    <!-- Telas que não possuem o navbar -->
    <RouterView v-if="['auth.sign-in', 'auth.sign-up', 'auth.forgot-password'].includes($route.name)" />
    <!-- Telas que possuem o navbar -->
    <div v-else>
        <NavBar  />
        <main class="lg:ml-64 pt-16">
            <MenuLateral />
            <RouterView />
        </main>
    </div>
</template>