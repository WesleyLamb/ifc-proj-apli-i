<script>
import ButtonComponent from '../forms/ButtonComponent.vue';

export default {
    components: {
        ButtonComponent
    },
    props: {
        title: String,
        subtitle: String,
        description: String,
        price: Number,
        to: Object,
        list: Array,
        buttonDescription: String,
        buttonColor: String,
        buttonDisabled: Boolean,
    }
}
</script>
<template>
    <div class="flex flex-col max-w-lg min-h-124 p-6 mt-4 mx-auto text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 xl:p-8 dark:bg-gray-800 dark:text-white">
        <div class="flex flex-col justify-between min-h-full">
            <div>
                <h3 class="mb-4 text-2xl font-semibold">{{ title }}</h3>
                <p v-if="subtitle != null" class="font-light text-gray-500 sm:text-lg dark:text-gray-400">{{ subtitle }}</p>
                <div class="flex items-baseline my-8">
                    <span class="mr-2 text-5xl font-extrabold">R$ {{ price.toLocaleString(undefined, {
                        minimumFractionDigits: 2
                    }) }}</span>
                    <span class="text-gray-500 dark:text-gray-400">/mês</span>
                </div>
            </div>
            <!-- List -->
            <ul v-if="list?.length > 0" role="list" class="mb-8 space-y-4 text-left">
                <li v-for="item in list" class="flex items-center space-x-3">
                    <!-- Icon -->
                    <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    <span>{{ item.description }}</span>
                </li>
            </ul>
            <ButtonComponent :text="buttonDescription" type="button" :color="buttonColor" :disabled="buttonDisabled" @button-click=""/>
        </div>
        <!-- <a href="#" class=" text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-primary-900">Get started</a> -->
      </div>
</template>