<script>
import { RouterLink } from 'vue-router';

export default {
    props: {
        label: String,
        to: Object
    }
}
</script>
<template>
    <RouterLink :to="to" class="ml-auto text-sm text-blue-500 hover:underline">{{ label }}</RouterLink>
</template>