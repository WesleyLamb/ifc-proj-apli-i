<script>
export default {
    props: {
        class: String,
    }
}

</script>
<template>
    <div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
        <slot></slot>
    </div>
</template>