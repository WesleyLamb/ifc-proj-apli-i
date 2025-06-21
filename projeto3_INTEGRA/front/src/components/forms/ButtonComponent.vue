<script>
export default {
    emits: ['button-click'],
    props: {
        type: String,
        text: String,
        disabled: Boolean,
    },
    methods: {

    }
}

</script>

<template>
    <button :type="type ? type : 'submit'" class="w-full min-w-32 px-5 py-3 text-base font-medium text-center text-white bg-blue-500 bg-primary rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-primary-300 sm:w-auto hover:cursor-pointer" @click="this.$emit('button-click')">{{ text }}</button>
</template>