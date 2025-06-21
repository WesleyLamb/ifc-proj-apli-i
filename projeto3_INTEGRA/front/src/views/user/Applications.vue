<script>

import MainHeader from '@/components/layout/MainHeader.vue';
import MainBody from '@/components/layout/MainBody.vue';
import Card from '@/components/layout/Card.vue';
import UserApplicationService from '@/services/UserApplicationService';

export default {
    components: {
        MainHeader,
        MainBody,
        Card
    },
    data: function() {
        return {
            applications: null
        }
    },
    mounted: function() {
        UserApplicationService.getApplications().then((response) => {
            this.applications = response.data.data;
            console.log(response.data.data);
        });
    }
}
</script>
<template>
    <MainHeader title="Aplicativos" :site-map="[
        {
            description: 'Aplicativos'
        }
    ]"/>
    <MainBody>
        <div class="grid grid-cols-4">
            <template v-for="application in applications">
                <Card :title="application.name" :price="application.value">

                </Card>
            </template>
        </div>
    </MainBody>
</template>