<script>
export default {
    emits: ['button-click'],
    props: {
        type: String,
        text: String,
        color: {
            type: String,
            default: 'blue',
        },
        disabled: {
            type: Boolean,
            default: false
        }
    },
    methods: {

    }
}
</script>
<template>
    <button :type="type ? type : 'submit'" :class="`bg-${this.color}-500 hover:bg-${this.color}-700`" class="w-full min-w-32 px-5 py-3 text-base font-medium text-center text-white bg-primary rounded-lg focus:ring-4 focus:ring-primary-300 sm:w-auto hover:not-disabled:cursor-pointer" @click="this.$emit('button-click')" :disabled="disabled">{{ text }}</button>
</template>