<template>
    <AdminLayout>
        <HeadingPage :title="title" :subtitle="subtitle">
            <template #actions>
                <BtnDialog title="Registrar Usuario" width="700px">
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
        <v-container fluid class="pt-0">
            <v-card>
                <DataTable
                    :headers="headers"
                    :items="items"
                    with-action
                    :url="url"
                >
                    <template v-slot:header="{ filter }">
                        <div class="pa-3">
                            <v-row justify="end">
                                <v-col cols="6">
                                    <v-text-field
                                        v-model="filter.search"
                                        label="Buscar"
                                    />
                                </v-col>
                            </v-row>
                        </div>
                    </template>

                    <template v-slot:item.is_active="{ item }">
                        <v-btn
                            :color="item.is_active ? 'blue' : 'red'"
                            variant="tonal"
                        >
                            <DialogConfirm
                                text="¿Activar/Desactivar?"
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
                                    variant="tonal"
                                    density="comfortable"
                                    @click="dialog"
                                >
                                    <v-icon
                                        size="18"
                                        icon="mdi-pencil"
                                    ></v-icon>
                                </v-btn>
                            </template>
                            <template v-slot:content="{ dialog }">
                                <create
                                    :form-structure="
                                        formStructure.filter(
                                            (field) => field.key !== 'password'
                                        )
                                    "
                                    @on-cancel="dialog"
                                    :form-data="item"
                                    :edit="true"
                                    :url="url + '/' + item[`${primaryKey}`]"
                                />
                            </template>
                        </BtnDialog>

                        <v-btn
                            icon
                            variant="tonal"
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
                            <v-icon size="18" icon="mdi-delete-empty"></v-icon>
                        </v-btn>
                    </template>
                </DataTable>
            </v-card>
        </v-container>
    </AdminLayout>
</template>
<script setup>
import AdminLayout from "@/layouts/AdminLayout.vue";
import HeadingPage from "@/components/HeadingPage.vue";
import BtnDialog from "@/components/BtnDialog.vue";
import DialogConfirm from "@/components/DialogConfirm.vue";
import DataTable from "@/components/DataTable.vue";
import { router } from "@inertiajs/core";
import create from "./create.vue";

const props = defineProps({
    title: String,
    subtitle: String,
    items: Object,
    headers: Object,
    filters: Object,
    areas: Array,
    permissions: Array,
});

const primaryKey = "id";
const url = "/a/users";

const formStructure = [
    {
        key: "document_number",
        label: "DNI",
        type: "text",
        required: true,
        cols: 12,
        colMd: 4,
        default: "",
    },
    {
        key: "name",
        label: "Nombre",
        type: "text",
        required: true,
        cols: 12,
        colMd: 8,
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
        key: "email",
        label: "Correo",
        type: "email",
        required: true,
        cols: 12,
        colMd: 6,
        default: "",
    },
    {
        key: "password",
        label: "Contraseña",
        type: "password",
        required: true,
        cols: 12,
        colMd: 6,
        default: "",
    },
    {
        key: "phone_number",
        label: "Teléfono",
        type: "text",
        required: true,
        cols: 12,
        colMd: 6,
        default: "",
    },
    {
        key: "role",
        label: "Rol",
        options: ["Administrador", "Operador"],
        type: "select",
        required: true,
        cols: 12,
        colMd: 6,
        default: null,
    },
    {
        key: "area_id",
        label: "Area",
        options: props.areas,
        type: "combobox",
        itemValue: "id",
        itemTitle: "name",
        required: true,
        placeholder: "Seleccione un area",
        cols: 12,
        default: null,
    },

    {
        key: "permissions",
        label: "Permisos",
        options: props.permissions,
        type: "combobox",
        itemValue: "name",
        itemTitle: "menu",
        required: true,
        cols: 12,

        default: null,
    },
];
</script>
