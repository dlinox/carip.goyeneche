<template>
    <AdminLayout>
        <HeadingPage :title="title" :subtitle="subtitle"> </HeadingPage>

        <v-container fluid>
            <v-row>
                <v-col cols="12" sm="6" md="4">
                    <v-card>
                        <v-toolbar flat density="compact" color="primary">
                            <v-toolbar-title>
                                <small> Usuarios </small>
                            </v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-icon class="me-3">mdi-account</v-icon>
                        </v-toolbar>
                        <v-card-item>
                            <v-avatar size="60" color="primary">
                                <span class="text-h5">{{users}}</span>
                            </v-avatar>
                            <span class="ms-4 text-h6 text-primary">
                                Usuarios registrados
                            </span>
                        </v-card-item>
                    </v-card>
                </v-col>

                <v-col cols="12" sm="6" md="4">
                    <v-card>
                        <v-toolbar flat density="compact" color="primary">
                            <v-toolbar-title>
                                <small> Doctores </small>
                            </v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-icon class="me-3">mdi-account</v-icon>
                        </v-toolbar>
                        <v-card-item>
                            <v-avatar size="60" color="primary">
                                <span class="text-h5">{{ doctors }}</span>
                            </v-avatar>
                            <span class="ms-4 text-h6 text-primary">
                                Doctores registrados
                            </span>
                        </v-card-item>
                    </v-card>
                </v-col>

                <v-col cols="12" sm="6" md="4">
                    <v-card>
                        <v-toolbar density="compact" color="primary">
                            <v-toolbar-title>
                                <small> Publicaciones </small>
                            </v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-icon class="me-3">mdi-account</v-icon>
                        </v-toolbar>
                        <v-card-item>
                            <v-avatar size="60" color="primary">
                                <span class="text-h5"> {{ posts }} </span>
                            </v-avatar>
                            <span class="ms-4 text-h6 text-primary">
                                Publicaciones
                            </span>
                        </v-card-item>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </AdminLayout>
</template>
<script setup>
import AdminLayout from "@/layouts/AdminLayout.vue";
import HeadingPage from "@/components/HeadingPage.vue";
import BtnDialog from "@/components/BtnDialog.vue";

const props = defineProps({
    title: String,
    subtitle: String,
    items: Object,
    headers: Array,
    filters: Object,

    users: [String, Number],
    doctors: [String, Number],
    posts: [String, Number],
});
</script>
