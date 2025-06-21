<script>
import Navigator from './Navigator.vue';
export default {
    components: {
        Navigator,
    },
    props: {
        siteMap: Array,
        title: String,
        description: String,
    }
}
</script>
<template>
    <div class="p-4 min-h-44 bg-white block sm:flex justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
        <div class="mb-4">
            <Navigator :items="siteMap"></Navigator>
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">{{ title }}</h1>
            <h3 v-if="description != null" class="mb-2 text-base font-normal text-gray-500 dark:text-gray-400">{{ description }}</h3>
        </div>
    </div>
</template>