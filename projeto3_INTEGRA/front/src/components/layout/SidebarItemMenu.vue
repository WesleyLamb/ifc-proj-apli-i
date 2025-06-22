<script>

export default {
    components: {
    },
    props: {
        description: String,
        dropdownIdentifier: String,
    },
    data() {
        return {
            hidden: true,
        }
    },
    methods: {
        toggle() {
            this.hidden = !this.hidden;
        }
    }
}
</script>

<template>
    <li>
        <button @click="toggle()" class="w-full hover:not-disabled:cursor-pointer flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <slot name="icon"></slot>
            <div class="w-full flex justify-between">
                <span class="ms-3">{{ description }}</span>
                <svg :class="!this.hidden ? 'rotate-180' : ''" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
        </button>
    </li>
    <template v-if="!this.hidden">
        <div class="pl-2">
            <slot></slot>
        </div>
    </template>
</template>