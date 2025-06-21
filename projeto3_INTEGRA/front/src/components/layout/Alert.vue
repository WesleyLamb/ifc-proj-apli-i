<script>
export default {
    props: {
        title: String,
        message: String,
        role: String
    }
}
</script>
<template>
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" :role="role">
        <span class="font-medium">{{ title + ':' }}</span> {{ message }}
    </div>
</template>