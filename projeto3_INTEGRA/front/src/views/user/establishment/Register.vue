<script>
import ButtonComponent from '@/components/forms/ButtonComponent.vue';
import InputComponent from '@/components/forms/InputComponent.vue';
import SelectComponent from '@/components/forms/SelectComponent.vue';
import MainBody from '@/components/layout/MainBody.vue';
import MainHeader from '@/components/layout/MainHeader.vue';
import UserEstablishmentService from '@/services/UserEstablishmentService';

export default {
    components: {
        MainHeader,
        MainBody,
        InputComponent,
        SelectComponent,
        ButtonComponent
    },
    data() {
        return {
            name: null,
            document: null,
            document_type: 'cnpj',
            logo: {
                data: null
            },
            logoFile: null
        }
    },
    methods: {
        createBase64Image(fileObject) {
            console.log(fileObject);
            const reader = new FileReader();

            reader.onload = (e) => {
                this.logo.data = e.target.result;
            };
            reader.readAsDataURL(fileObject);
        },
        store: function() {
            UserEstablishmentService.registerEstablishment({
                name: this.name,
                document: this.document,
                document_type: this.document_type,
                logo: this.logo
            }).then((response) => {
                this.$router.push({path: '/'});
            });
        }
    },
    watch: {
        logoFile(newVal, oldVal) {
            console.log('oldVal: ' + oldVal + ' newVal: ' + newVal);
            if (newVal) {
                this.logo.data = this.createBase64Image(newVal);
            }
        }
    }
}
</script>
<template>
    <MainHeader title="Estabelecimentos" description="É necessário cadastrar um estabelecimento antes de continuar" :site-map="[
        {
            description: 'Estabelecimentos'
        }
    ]"/>
    <MainBody>
        <div class="p-4 bg-white block sm:flex justify-between border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <form class="space-y-6 min-w-64" action="">
                <InputComponent type="text" label="Nome" placeholder="Nome da sua empresa" required v-model:value="name" />
                <div class="grid grid-cols-2">
                    <SelectComponent type="text" label="Tipo" placeholder="Documento" :items="[
                        {
                            value: 'cnpj',
                            label: 'CNPJ'
                        }
                    ]" required v-model:value="document_type" />
                    <InputComponent type="text" label="Documento" placeholder="11.111.111/1111-11" required v-model:value="document"/>
                </div>
                <InputComponent type="file" label="Logotipo" accept="image/*" required v-model:value="logoFile"/>
                <ButtonComponent type="button" text="Salvar" @button-click="store()"/>
            </form>
        </div>
    </MainBody>
</template>