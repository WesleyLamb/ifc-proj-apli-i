<script>
export default {
    props: {
        type: String,
        id: String,
        label: String,
        placeholder: String,
        required: Boolean
    },
    emits: ['update:value']
}

</script>

<template>
    <div v-if="['text', 'password', 'email' ].includes(type)">
        <label :for="id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ label }}</label>
        <input :type="type" :name="id" :id="id" @input="$emit('update:value', $event.target.value)" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" :placeholder="placeholder" :required="required">
    </div>
    <div v-else-if="['checkbox'].includes(type)">
        <div class="flex items-center h-5">
            <input :id="id" :name="id" :type="type" @input="$emit('update:value', $event.target.value)" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300" :required="required">
            <label :for="id" class="ml-3 text-sm font-medium text-gray-900">{{ label }}</label>
        </div>
    </div>
</template>