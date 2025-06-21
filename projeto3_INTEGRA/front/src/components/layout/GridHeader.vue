<script>
import Navigator from './Navigator.vue';
export default {
    components: {
        Navigator,
    },
    props: {
        siteMap: Array,
        title: String,
    }
}
</script>
<template>
    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
        <div class="mb-4">
            <Navigator :items="siteMap"></Navigator>
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">{{ title }}</h1>
        </div>
    </div>
</template>