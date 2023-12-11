<template>
    <AdminLayout>
        <HeadingPage title="Noticias" subtitle="Gestion de Noticias">
            <template #actions>
                <v-btn
                    @click="router.get(url + '/create')"
                    prepend-icon="mdi-plus"
                    variant="flat"
                >
                    Nuevo
                </v-btn>
            </template>
        </HeadingPage>

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
                                <v-col cols="6"> </v-col>
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

                        <template v-slot:item.is_featured="{ item }">
                            <v-btn
                                :color="
                                    item.is_featured
                                        ? 'cyan-darken-4'
                                        : 'seconday'
                                "
                                variant="tonal"
                            >
                                <DialogConfirm
                                    :text="
                                        item.is_featured
                                            ? '¿Quitar de destacados?'
                                            : '¿Destacar noticia?'
                                    "
                                    @onConfirm="
                                        () =>
                                            router.patch(
                                                url +
                                                    '/' +
                                                    item[`${primaryKey}`] +
                                                    '/change-featured'
                                            )
                                    "
                                />
                                {{ item.is_featured ? "Destacado" : "Normal" }}
                            </v-btn>
                        </template>
                        <template v-slot:action="{ item }">
                            <v-btn
                                variant="outlined"
                                density="comfortable"
                                class="ml-1"
                                color="blue"
                                icon="mdi-pencil"
                                @click="
                                    router.get(
                                        url +
                                            '/' +
                                            item[`${primaryKey}`] +
                                            '/' +
                                            'edit'
                                    )
                                "
                            />

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
import DialogConfirm from "@/components/DialogConfirm.vue";
import DataTable from "@/components/DataTable.vue";

import { router } from "@inertiajs/core";

const props = defineProps({
    items: Object,
    headers: Array,
    filters: Object,
});

const primaryKey = "id";
const url = "/a/news";
</script>
