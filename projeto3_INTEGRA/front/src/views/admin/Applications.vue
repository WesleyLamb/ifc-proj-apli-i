<script>
import MainHeader from '@/components/layout/MainHeader.vue';

export default {
    components: {
        MainHeader
    }
}
</script>
<template>
    <MainHeader title="Aplicativos" :site-map="[
        {
            description: 'Aplicativos'
        }
    ]"/>
</template>