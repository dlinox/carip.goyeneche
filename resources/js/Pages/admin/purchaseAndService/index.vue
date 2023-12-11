<template>
    <AdminLayout>
        <HeadingPage
            title="Compra y servicio"
            subtitle="Gestion de información"
        >
            <template #actions>
                <BtnDialog v-if="item" title="Nuevo" width="700px">
                    <template v-slot:activator="{ dialog }">
                        <v-btn
                            @click="dialog"
                            prepend-icon="mdi-pencil"
                            variant="flat"
                        >
                            Editar
                        </v-btn>
                    </template>
                    <template v-slot:content="{ dialog }">
                        <create
                            :form-structure="formStructure"
                            @on-cancel="dialog"
                            :url="url + '/' + item[`${primaryKey}`]"
                            :edit="true"
                            :form-data="item"
                        />
                    </template>
                </BtnDialog>

                <BtnDialog v-else title="Nuevo" width="700px">
                    <template v-slot:activator="{ dialog }">
                        <v-btn
                            @click="dialog"
                            prepend-icon="mdi-plus"
                            variant="flat"
                        >
                            Nuevo
                        </v-btn>
                    </template>
                    <template v-slot:content="{ dialog }">
                        <create
                            :form-structure="formStructure"
                            @on-cancel="dialog"
                            :url="url"
                        />
                    </template>
                </BtnDialog>
            </template>
        </HeadingPage>

        <v-container>
            <v-list-item
                v-if="item"
                :title="item.url_information"
                subtitle="URL que redirigirá a la información completa de la orden en la web"
            >
                <template v-slot:prepend>
                    <v-avatar
                        class="pa-1"
                        color="grey-lighten-1"
                        rounded="sm"
                        size="120"
                        image="/assets/logos/svsc.png"
                    >
                    </v-avatar>
                </template>
            </v-list-item>
        </v-container>
    </AdminLayout>
</template>
<script setup>
import AdminLayout from "@/layouts/AdminLayout.vue";
import HeadingPage from "@/components/HeadingPage.vue";
import BtnDialog from "@/components/BtnDialog.vue";
import create from "./create.vue";

const props = defineProps({
    item: Object,
});

const primaryKey = "id";
const url = "/a/purchase-and-service";

const formStructure = [
    {
        key: "url_information",
        label: "Ingresar la URL",
        type: "text",
        required: true,
        cols: 12,
        default: "",
    },
];
</script>
