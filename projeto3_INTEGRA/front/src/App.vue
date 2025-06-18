<script setup>
    import { onMounted } from 'vue';
    import { initFlowbite } from 'flowbite';
    import { RouterView } from 'vue-router';
    import MenuLateral from './components/MenuLateral.vue';
    import NavBar from './components/NavBar.vue';

    // initialize components based on data attribute selectors
    onMounted(() => {
        initFlowbite();
    })
</script>

<template>
    <div v-if="$route.name != 'login'">
        <NavBar  />
        <main class="lg:ml-64 pt-16">
            <MenuLateral />
            <RouterView />
        </main>
    </div>
    <div v-else>
        <RouterView />
    </div>
</template>