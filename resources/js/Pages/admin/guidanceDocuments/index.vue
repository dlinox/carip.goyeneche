<template>
    <AdminLayout>
        <HeadingPage :title="title" :subtitle="subtitle" class="bg-white">
            <template #actions>
                <BtnDialog title="Nuevo" width="700px">
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
                            @on-cancel="dialog"
                            :formStructure="formStructure"
                            :url="url"
                        />
                    </template>
                </BtnDialog>
            </template>
        </HeadingPage>

        <v-container fluid>
            <v-card>
                <v-card-item>
                    <DataTable
                        :headers="headers"
                        :items="items"
                        :url="url"
                        withAction
                    >
                        <template v-slot:header="{ filter }">
                            <v-row class="py-3" justify="end">
                                <v-col cols="6">
                                    <v-text-field
                                        v-model="filter.search"
                                        label="Buscar"
                                    />
                                </v-col>
                            </v-row>
                        </template>

                        <template v-slot:item.guide_file="{ item }">
                           <v-img
                                :src="item.guide_file_url"
                                :alt="item.guide_name"
                                width="100"
                                contain
                            />
                 

                        </template>

                        <template v-slot:item.resolution_file="{ item }">
                            <v-img
                                :src="item.resolution_file_url"
                                :alt="item.guide_name"
                                width="100"
                                contain
                            />
                        </template>

                        <template v-slot:item.is_active="{ item }">
                            <v-btn
                                :color="item.is_active ? 'blue' : 'red'"
                                variant="tonal"
                            >
                                <DialogConfirm
                                    text="¿Cambiar estado del usuario?"
                                    @onConfirm="
                                        () =>
                                            router.patch(
                                                url +
                                                    '/' +
                                                    item[`${primaryKey}`] +
                                                    '/change-state'
                                            )
                                    "
                                />
                                {{ item.is_active ? "Activo" : "Inactivo" }}
                            </v-btn>
                        </template>

                        <template v-slot:action="{ item }">
                            <BtnDialog title="Editar" width="500px">
                                <template v-slot:activator="{ dialog }">
                                    <v-btn
                                        color="info"
                                        icon
                                        variant="outlined"
                                        density="comfortable"
                                        @click="dialog"
                                    >
                                        <v-icon
                                            size="x-small"
                                            icon="mdi-pencil"
                                        ></v-icon>
                                    </v-btn>
                                </template>
                                <template v-slot:content="{ dialog }">
                                    <create
                                        @on-cancel="dialog"
                                        :formStructure="formStructure"
                                        :form-data="item"
                                        :edit="true"
                                        :url="url"
                                    />
                                </template>
                            </BtnDialog>

                            <v-btn
                                icon
                                variant="outlined"
                                density="comfortable"
                                class="ml-1"
                                color="red"
                            >
                                <DialogConfirm
                                    @onConfirm="
                                        () =>
                                            router.delete(
                                                url +
                                                    '/' +
                                                    item[`${primaryKey}`]
                                            )
                                    "
                                />
                                <v-icon
                                    size="x-small"
                                    icon="mdi-delete-empty"
                                ></v-icon>
                            </v-btn>
                        </template>
                    </DataTable>
                </v-card-item>
            </v-card>
        </v-container>
    </AdminLayout>
</template>
<script setup>
import AdminLayout from "@/layouts/AdminLayout.vue";
import HeadingPage from "@/components/HeadingPage.vue";
import { router } from "@inertiajs/vue3";
import BtnDialog from "../../../components/BtnDialog.vue";
import create from "./create.vue";
import DataTable from "@/components/DataTable.vue";
import DialogConfirm from "@/components/DialogConfirm.vue";

const props = defineProps({
    title: String,
    subtitle: String,
    items: Object,
    headers: Array,
    filters: Object,
});

const formStructure = [
    {
        key: "date_published",
        label: "Fecha de publicacion",
        type: "date",
        required: true,
        cols: 12,
        //default fecha actual
        default: new Date().toISOString().slice(0, 10),
    },
    {
        key: "guide_name",
        label: "Circuito de atencion de : ",
        type: "text",
        //select de servicios de apoyo
        required: true,
        cols: 12,
        default: "",
    },
    {
        key: "guide_file",
        label: "Archivo Guia",
        type: "text",
        required: true,
        cols: 12,
        default: null,
    },
    {
        //OPCIONAL
        key: "resolution_name",
        label: "Circuito de atencion complementario ",
        type: "text",
        required: false,
        cols: 12,
        default: null,
    },
    {
        key: "resolution_file",
        label: "Resolucion",
        type: "text",
        required: false,
        cols: 12,
        default: null,
    },
];

const primaryKey = "id";
const url = "/a/guidance-documents";
</script>
