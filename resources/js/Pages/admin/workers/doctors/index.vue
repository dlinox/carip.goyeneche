<template>
    <v-container fluid>
        <v-card>
            <v-card-item>
                <DataTable
                    :headers="headers"
                    :items="items"
                    with-action
                    :url="url"
                >
                    <template v-slot:header="{ filter }">
                        <v-row class="py-3" justify="end">
                            <v-col cols="6">
                                <BtnDialog title="Nuevo" width="700px">
                                    <template v-slot:activator="{ dialog }">
                                        <v-btn
                                            @click="dialog"
                                            prepend-icon="mdi-plus"
                                            variant="flat"
                                        >
                                            Doctor
                                        </v-btn>
                                    </template>
                                    <template v-slot:content="{ dialog }">
                                        <create
                                            @on-cancel="dialog"
                                            :formStructure="formStructureDoctor"
                                            :url="url"
                                        />
                                    </template>
                                </BtnDialog>
                            </v-col>
                            <v-col cols="6">
                                <v-text-field
                                    v-model="filter.search"
                                    label="Buscar"
                                />
                            </v-col>
                        </v-row>
                    </template>

                    <template v-slot:item.photo="{ item }">
                        
                        <v-img
                            v-if="item.photo"
                            :src="`/storage/${item.photo}`"
                            width="50px"
                            height="50px"
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
                                    :formStructure="formStructureDoctor"
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
                                            url + '/' + item[`${primaryKey}`]
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
</template>
<script setup>
import BtnDialog from "@/components/BtnDialog.vue";
import DialogConfirm from "@/components/DialogConfirm.vue";
import DataTable from "@/components/DataTable.vue";
import create from "@/Pages/admin/workers/doctors/create.vue";

import { router } from "@inertiajs/core";

const props = defineProps({
    items: Object,
    headers: Array,
    filters: Object,
    specialties: Array,
});

const primaryKey = "id";
const url = "/a/workers";

const formStructureDoctor = [
    {
        key: "document_number",
        label: "DNI",
        type: "text",
        required: true,
        cols: 12,
        colMd: 6,
        default: "",
    },
    {
        key: "registration_code",
        label: "Nro. de Colegiatura",
        type: "text",
        required: true,
        cols: 12,
        colMd: 6,
        default: "",
    },
    {
        key: "name",
        label: "Nombre",
        type: "text",
        required: true,
        cols: 12,
        default: "",
    },
    {
        key: "paternal_surname",
        label: "Apellido Paterno",
        type: "text",
        required: true,
        cols: 12,
        colMd: 6,
        default: "",
    },
    {
        key: "maternal_surname",
        label: "Apellido Materno",
        type: "text",
        required: true,
        cols: 12,
        colMd: 6,
        default: "",
    },
    {
        key: "specialty_id",
        label: "Especialidad",
        type: "combobox",
        itemTitle: "name",
        itemValue: "id",
        options: props.specialties,
        required: true,
        cols: 12,
        default: "",
    },
    {
        key: "description",
        label: "Descripción",
        type: "textarea",
        required: false,
        cols: 12,
        default: "",
    },
    {
        key: "photo",
        label: "Foto",
        type: "file",
        required: true,
        cols: 12,
        default: null,
    },
];
</script>
