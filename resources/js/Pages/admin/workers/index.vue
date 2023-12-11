<template>
    <AdminLayout>
        <v-card>
            <HeadingPage
                title="Personal"
                subtitle="Gestion del personal"
                class="bg-white"
            >
            </HeadingPage>

            <v-tabs v-model="tab" color="primary">
                <!-- <v-tab :value="0"> Todos</v-tab> -->
                <v-tab :value="1"> Doctores </v-tab>
                <v-tab :value="2"> Autoridades </v-tab>
            </v-tabs>
        </v-card>
        <v-window v-model="tab">
            <v-window-item :value="0">
                <v-container>
                    <v-data-table
                        responsive
                        :headers="headers2"
                        :items="items.data"
                        :sort-by="[{ key: 'id', order: 'asc' }]"
                        multi-sort
                    ></v-data-table>
                </v-container>
            </v-window-item>
            <v-window-item :value="1">
                <DoctorsIndex
                    :items="items"
                    :headers="headers"
                    :filters="filters"
                    :specialties="specialties"
                />
            </v-window-item>
            <v-window-item :value="2">
                <AuthoritiesIndex
                    :items="itemsAuthorities"
                    :itemsWorkers="items"
                />
            </v-window-item>
        </v-window>
    </AdminLayout>
</template>
<script setup>
import { ref } from "vue";
import AdminLayout from "@/layouts/AdminLayout.vue";
import HeadingPage from "@/components/HeadingPage.vue";

import DoctorsIndex from "@/Pages/admin/workers/doctors/index.vue";
import AuthoritiesIndex from "./authorities/index.vue";

const props = defineProps({
    items: Object,
    headers: Array,
    filters: Object,
    itemsAuthorities: Object | Array,
    perPageOptions: Array,
    specialties: Array,
});

const tab = ref(1);

const headers2 = [
    { title: "ID", key: "id" },
    {
        title: "Dessert (100g serving)",
        align: "start",
        sortable: false,
        key: "fullname",
    },
];
</script>
