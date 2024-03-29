<template>
    <AdminLayout>
        <HeadingPage :title="title" :subtitle="subtitle">
            <template #actions>
                <BtnDialog title="Registrar Slider" width="700px">
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

                    <template v-slot:item.image_url="{ item }">
                        <v-img
                            :src="item.image_url"
                            width="100"
                            height="100"
                            contain
                        ></v-img>
                    </template>

                    <template v-slot:item.more_info_url="{ item }">
                        <a :href="item.more_info_url" target="_blank">
                            {{ item.more_info_url }}
                        </a>
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
                                    :form-structure="formStructure"
                                    @on-cancel="dialog"
                                    :form-data="item"
                                    :edit="true"
                                    :url="url"
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
import create from "@/Pages/admin/sliders/create.vue";

const props = defineProps({
    title: String,
    subtitle: String,
    items: Object,
    headers: Object,
    filters: Object,
});

const primaryKey = "id";
const url = "/a/advertisements";

const formStructure = [
    {
        key: "image",
        label: "Imagen",
        type: "file",
        required: true,
        cols: 12,
        default: "",
    },
    {
        key: "title",
        label: "Titulo",
        type: "text",
        required: false,
        cols: 12,
        default: "",
    },

    {
        key: "more_info_url",
        label: "Url de mas informacion",
        type: "text",
        required: false,
        cols: 12,
        default: null,
    },
];
</script>
