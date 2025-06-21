<script>
import GridHeader from '@/components/layout/GridHeader.vue';
import Jumbotron from '@/components/layout/Jumbotron.vue';
import Navigator from '@/components/layout/Navigator.vue';
export default {
    components: {
        Navigator,
        GridHeader,
        Jumbotron,
    }
}
</script>
<template>
    <GridHeader title="Dashboard" :site-map="[
            {
                description: 'Dashboard'
            },
            {
                description: 'Dashboard 2',
                to: {path: '/'}
            },
            {
                description: 'Dashboard 3',
                to: {path: '/'}
            },
            {
                description: 'Dashboard 4',
                to: {path: '/'}
            },
        ]">

    </GridHeader>
    <Jumbotron title="Em construção" description="Aguarde, em breve teremos novidades nesta página."></Jumbotron>
</template>