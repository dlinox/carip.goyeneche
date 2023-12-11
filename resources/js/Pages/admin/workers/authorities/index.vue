<template>
    <v-container fluid>
        <v-card>
            <HeadingPage title="">
                <template v-slot:actions>
                    <v-btn color="primary" variant="flat" @click="register()">
                        <v-icon>mdi-plus</v-icon>
                        Nuevo
                    </v-btn>
                </template>
            </HeadingPage>

            <v-list>
                <v-list-item v-for="(item, index) in items" :key="index">
                    <template v-slot:prepend>
                        <v-avatar>
                            <v-icon>mdi-circle-off-outline</v-icon>
                        </v-avatar>
                    </template>
                    <!-- <v-list-item-avatar>
                        <v-img :src="item.avatar"></v-img>
                    </v-list-item-avatar> -->

                    <v-list-item-title class="text-uppercase">
                        {{ item.worker ? item.worker.full_name : "No asignado" }}
                    </v-list-item-title>
                    <v-list-item-subtitle>
                        <strong class="text-primary">{{
                            item.position
                        }}</strong>
                    </v-list-item-subtitle>

                    <template v-slot:append>
                        <v-btn
                            icon
                            density="compact"
                            variant="tonal"
                            rounded="full"
                        >
                            <v-icon>mdi-dots-vertical</v-icon>

                            <v-menu activator="parent">
                                <v-list>
                                    <v-list-item
                                        @click="assignWorker(item)"
                                        title="Editar"
                                    />
                                    <!-- @click="router.delete(`/a/workers/authorities/${item.id}`)" -->
                                    <v-list-item title="Eliminar">
                                        <DialogConfirm
                                            @onConfirm="
                                                () =>
                                                    router.delete(
                                                        `/a/workers/authorities/${item.id}`
                                                    )
                                            "
                                        />
                                    </v-list-item>
                                </v-list>
                            </v-menu>
                        </v-btn>
                    </template>
                </v-list-item>
            </v-list>
        </v-card>
    </v-container>

    <v-dialog v-model="dialogAssign" width="500">
        <v-form>
            <v-card>
                <pre>
                    {{ form }}
                </pre>
                <v-toolbar variant="compact" title="Editar" />
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <v-text-field
                                v-model="form.position"
                                :items="items"
                                label="Posicion"
                                class="mt-2"
                            />
                        </v-col>
                        <v-col cols="12">
                            <v-combobox
                                v-model="form.worker_id"
                                :items="itemsWorkers.data"
                                item-title="full_name"
                                item-value="id"
                                label="Trabajador"
                                class="mt-2"
                                :return-object="false"
                            />
                        </v-col>
                    </v-row>
                </v-container>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="dialogAssign = false">
                        Cancelar
                    </v-btn>
                    <v-btn color="primary" variant="flat" @click="saveAssign">
                        Guardar
                    </v-btn>
                </v-card-actions>

            </v-card>
        </v-form>
       
    </v-dialog>
</template>
<script setup>
import { ref } from "vue";
import HeadingPage from "@/components/HeadingPage.vue";
import { router, useForm } from "@inertiajs/vue3";
import DialogConfirm from "@/components/DialogConfirm.vue";

const props = defineProps({
    items: Object | Array,
    itemsWorkers: Array | Object,
});

const dialogAssign = ref(false);

const form = useForm({
    id: null,
    position: null,
    worker_id: null,
});

const register = () => {
    form.reset();
    dialogAssign.value = true;
};

const assignWorker = (item) => {
    form.reset();

    form.id = item.id;
    form.position = item.position;
    form.worker_id = item.worker_id;
    dialogAssign.value = true;
};

const saveAssign = () => {
    form.post("/a/workers/authorities", {
        onSuccess: (page) => {
            console.log("onSuccess");
            dialogAssign.value = false;

            form.reset();
        },
        onError: (errors) => {
            console.log("onError");
        },
        onFinish: (visit) => {
            console.log("onFinish");
        },
    });
    console.log("guardar");
};
</script>
