<script>
import { RouterLink } from 'vue-router';

export default {
    props: {
        label: String,
        name: String,
        params: Object,
    }
}
</script>
<template>
    <RouterLink :to="{name: name, params: params}" class="ml-auto text-sm text-blue-500 hover:underline">{{ label }}</RouterLink>
</template>