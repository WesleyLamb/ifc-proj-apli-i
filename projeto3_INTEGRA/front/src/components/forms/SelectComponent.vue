<script>
export default {
    props: {
        id: String,
        label: String,
        placeholder: String,
        required: Boolean,
        items: Array,
    }
}
</script>
<template>
    <div class="px-2">
        <label :for="id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ label }}</label>
        <select :id="id" @change="$emit('update:value', $event.target.value); console.log($event.target.value)" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" :required="required">
            <option v-for="item in items" :value="item.value">{{ item.label }}</option>
        </select>
    </div>
</template>