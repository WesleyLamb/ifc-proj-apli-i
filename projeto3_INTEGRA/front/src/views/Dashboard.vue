<script>
import MainHeader from '@/components/layout/MainHeader.vue';
import Jumbotron from '@/components/layout/Jumbotron.vue';
import Navigator from '@/components/layout/Navigator.vue';
import MainBody from '@/components/layout/MainBody.vue';
export default {
    components: {
        Navigator,
        MainHeader,
        MainBody,
        Jumbotron,
    }
}
</script>
<template>
    <MainHeader title="Dashboard" :site-map="[
            {
                description: 'Dashboard'
            }
        ]"/>
    <MainBody>
        <Jumbotron title="Em construção" description="Aguarde, em breve teremos novidades nesta página."></Jumbotron>
    </MainBody>
</template>