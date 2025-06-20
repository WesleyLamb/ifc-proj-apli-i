<script>
export default {
    props: {
        link: String,
        label: String
    }
}
</script>
<template>
    <a :href="link" class="ml-auto text-sm text-primary-700 hover:underline dark:text-primary-500">{{ label }}</a>
</template>