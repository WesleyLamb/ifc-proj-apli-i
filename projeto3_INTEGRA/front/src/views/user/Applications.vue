<script>

import MainHeader from '@/components/layout/MainHeader.vue';
import MainBody from '@/components/layout/MainBody.vue';
import Card from '@/components/layout/Card.vue';
import UserApplicationService from '@/services/UserApplicationService';
import UserEstablishmentService from '@/services/UserEstablishmentService';

export default {
    components: {
        MainHeader,
        MainBody,
        Card
    },
    data: function() {
        return {
            applications: null,
            establishment: null
        }
    },
    mounted: function() {
        UserEstablishmentService.showEstablishment(UserEstablishmentService.getDefaultEstablishmentId()).then((response1) => {
            this.establishment = response1.data.data;
            UserApplicationService.getApplications(this.establishment.id).then((response2) => {
                this.applications = response2.data.data;
            });
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
                <Card :title="application.name" :price="application.value" :button-description="application.adquired ? 'Já adquirido' : 'Adquirir'" :button-color="application.adquired ? 'gray' : 'blue'" :button-disabled="application.adquired">

                </Card>
            </template>
        </div>
    </MainBody>
</template>