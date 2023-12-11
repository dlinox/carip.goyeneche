<template>
    <AdminLayout>
        <v-card rounded="0">
            <HeadingPage
                title="institucion"
                subtitle="Gestión Institucional"
                class="bg-white"
            >
                <template #actions>
                    <v-btn
                        v-if="tab !== 4"
                        prepend-icon="mdi-check"
                        variant="flat"
                        @click="submit"
                    >
                        Guardar cambios
                    </v-btn>
                </template>
            </HeadingPage>

            <v-tabs v-model="tab" color="primary">
                <v-tab :value="0"> General</v-tab>
                <v-tab :value="1"> Mision / Vision </v-tab>
                <v-tab :value="2"> Organigrama </v-tab>
                <v-tab :value="3"> ¿Quiénes Somos ? </v-tab>
                <v-tab :value="4"> Objetivos </v-tab>
            </v-tabs>
        </v-card>

        <v-container v-if="form.hasErrors" class="pb-0">

            <v-alert type="error" variant="tonal">
                <p v-for="error in form.errors" :key="error">
                    {{ error }}
                </p>
            </v-alert>
        </v-container>

        <v-window v-model="tab">
            <v-window-item :value="0">
                <v-container>
                    <v-card>
                        <v-row>
                            <v-col cols="12" >
                                <v-card variant="tonal">
                                        <small class="text-red">
                                            {{ form.errors.logo }}
                                        </small>
                                        <CropCompressImage
                                        text="Seleccionar logo"
                                            :aspect-ratio="1 / 1"
                                            @onCropper="
                                                (previewLogo = $event.blob),
                                                    (form.logo =
                                                        $event.file)
                                            "
                                        />

                                        <v-img
                                            v-if="previewLogo"
                                            class="mx-auto"
                                            :width="200"
                                            aspect-ratio="1/1"
                                            cover
                                            :src="previewLogo"
                                        ></v-img>

                                        <v-img
                                            v-if="
                                                form.logo_url &&
                                                !previewLogo
                                            "
                                            class="mx-auto"
                                            :width="200"
                                            aspect-ratio="1/1"
                                            cover
                                            :src="form.logo_url"
                                        ></v-img>
                                    </v-card>
                            </v-col>


                        </v-row>
                        <v-card-item>
                            <v-row>
                                <v-col cols="12">
                                    <div class="mb-1 font-weight-medium">
                                        Nombre de la institucion
                                    </div>
                                    <v-text-field
                                        v-model="form.name"
                                        placeholder="Nombre de la institucion"
                                        :error-messages="form.errors.name"
                                    />
                                </v-col>

                                <v-col cols="12">
                                    <div class="mb-1 font-weight-medium">
                                        Descripción
                                    </div>
                                    <v-text-field
                                        v-model="form.description"
                                        placeholder="Descripción"
                                        :error-messages="
                                            form.errors.description
                                        "
                                    />
                                </v-col>

                                <v-col cols="12">
                                    <div class="mb-1 font-weight-medium">
                                        Dirección
                                    </div>
                                    <v-text-field
                                        v-model="form.address"
                                        placeholder="Dirección"
                                        :error-messages="form.errors.address"
                                    />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <div class="mb-1 font-weight-medium">
                                        Telefono
                                    </div>
                                    <v-text-field
                                        v-model="form.phone"
                                        placeholder="Telefono"
                                        :error-messages="form.errors.phone"
                                    />
                                </v-col>

                                <v-col cols="12" md="6">
                                    <div class="mb-1 font-weight-medium">
                                        Correo
                                    </div>
                                    <v-text-field
                                        v-model="form.email"
                                        placeholder="Correo"
                                        :error-messages="form.errors.email"
                                    />
                                </v-col>
                            </v-row>
                        </v-card-item>
                    </v-card>
                </v-container>
            </v-window-item>

            <v-window-item :value="1">
                <v-container>
                    <v-card>
                        <v-card-item>
                            <v-row>
                                <v-col cols="12">
                                    <div class="mb-1 font-weight-medium">
                                        Mision
                                    </div>
                                    <v-card>
                                        <small class="text-red">
                                            {{ form.errors.mission }}
                                        </small>
                                        <quill-editor
                                            contentType="html"
                                            v-model:content="form.mission"
                                            theme="snow"
                                        ></quill-editor>
                                    </v-card>
                                </v-col>

                                <v-col cols="12">
                                    <div class="mb-1 font-weight-medium">
                                        Vision
                                    </div>
                                    <v-card>
                                        <small class="text-red">
                                            {{ form.errors.vision }}
                                        </small>
                                        <quill-editor
                                            contentType="html"
                                            v-model:content="form.vision"
                                            theme="snow"
                                        ></quill-editor>
                                    </v-card>
                                </v-col>
                            </v-row>
                        </v-card-item>
                    </v-card>
                </v-container>
            </v-window-item>
            <v-window-item :value="2">
                <v-container>
                    <v-card>
                        <v-card-item>
                            <v-row>
                                <v-col cols="12">
                                    <div class="mb-1 font-weight-medium">
                                        Organigrama
                                    </div>
                                    <v-card variant="tonal">
                                        <small class="text-red">
                                            {{ form.errors.organigram }}
                                        </small>
                                        <CropCompressImage
                                            :aspect-ratio="16 / 9"
                                            @onCropper="
                                                (previewImg = $event.blob),
                                                    (form.organigram =
                                                        $event.file)
                                            "
                                        />

                                        <v-img
                                            v-if="previewImg"
                                            class="mx-auto"
                                            :width="800"
                                            aspect-ratio="16/9"
                                            cover
                                            :src="previewImg"
                                        ></v-img>

                                        <v-img
                                            v-if="
                                                form.organigram_url &&
                                                !previewImg
                                            "
                                            class="mx-auto"
                                            :width="800"
                                            aspect-ratio="16/9"
                                            cover
                                            :src="form.organigram_url"
                                        ></v-img>
                                    </v-card>
                                </v-col>
                            </v-row>
                        </v-card-item>
                    </v-card>
                </v-container>
            </v-window-item>

            <v-window-item :value="3">
                <v-container>
                    <v-card>
                        <v-card-item>
                            <v-row>
                                <v-col cols="12">
                                    <div class="mb-1 font-weight-medium">
                                        ¿Quiénes Somos ?
                                    </div>
                                    <v-card height="300">
                                        <small class="text-red">
                                            {{ form.errors.about_us }}
                                        </small>
                                        <quill-editor
                                            contentType="html"
                                            v-model:content="form.about_us"
                                            theme="snow"
                                        ></quill-editor>
                                    </v-card>
                                </v-col>
                            </v-row>
                        </v-card-item>
                    </v-card>
                </v-container>
            </v-window-item>

            <v-window-item :value="4">
                <v-container>
                    <v-card>
                        <v-card-item>
                            <v-row>
                                <v-col cols="12">
                                    <BtnDialog title="Nuevo" width="700px">
                                        <template v-slot:activator="{ dialog }">
                                            <v-btn
                                                @click="dialog"
                                                prepend-icon="mdi-plus"
                                                variant="flat"
                                                block
                                            >
                                                AGREGAR OBJETIVO
                                            </v-btn>
                                        </template>
                                        <template v-slot:content="{ dialog }">
                                            <createObjetive
                                                @on-cancel="dialog"
                                                :url="url"
                                            />
                                        </template>
                                    </BtnDialog>
                                </v-col>
                            </v-row>
                        </v-card-item>

                        <v-card-item>
                            <v-list-item
                                v-for="item in objetives"
                                :key="item.id"
                                :title="item.name"
                            >
                                <template v-slot:prepend>
                                    <v-avatar color="grey-lighten-1">
                                        <v-icon color="white"
                                            >mdi-folder</v-icon
                                        >
                                    </v-avatar>
                                </template>

                                <template v-slot:append>
                                    <BtnDialog title="Nuevo" width="700px">
                                        <template v-slot:activator="{ dialog }">
                                            <v-btn
                                                @click="dialog"
                                                icon="mdi-pencil"
                                                variant="tonal"
                                                icon-size="x-small"
                                                density="comfortable"
                                                color="blue"
                                            >
                                            </v-btn>
                                        </template>
                                        <template v-slot:content="{ dialog }">
                                            <createObjetive
                                                @on-cancel="dialog"
                                                :edit="true"
                                                :form-data="item"
                                                :url="
                                                    url +
                                                    '/' +
                                                    item[`${primaryKey}`]
                                                "
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
                                                            item[
                                                                `${primaryKey}`
                                                            ]
                                                    )
                                            "
                                        />
                                        <v-icon
                                            size="x-small"
                                            icon="mdi-delete-empty"
                                        ></v-icon>
                                    </v-btn>
                                </template>
                            </v-list-item>
                        </v-card-item>
                    </v-card>
                </v-container>
            </v-window-item>
        </v-window>
    </AdminLayout>
</template>
<script setup>
import { ref } from "vue";
import AdminLayout from "@/layouts/AdminLayout.vue";
import HeadingPage from "@/components/HeadingPage.vue";
import CropCompressImage from "@/components/CropCompressImage.vue";
import { router, useForm } from "@inertiajs/vue3";
import BtnDialog from "@/components/BtnDialog.vue";
import DialogConfirm from "@/components/DialogConfirm.vue";

import createObjetive from "./createObjetive.vue";
const props = defineProps({
    institutional: Object,
    objetives: Array,
});

const url = "/a/institutional-objetives";
const primaryKey = "id";
const tab = ref(0);

const previewImg = ref(null);
const previewLogo = ref(null);

const form = useForm({
    name: "",
    description: "",
    address: "",
    phone: "",
    email: "",
    mission: "",
    vision: "",
    about_us: "",
    ...props.institutional,
    organigram: null,
    logo: null,

});

const submit = async () => {
    console.log(form);
    form.post("/a/institutional-information", {
        onSuccess: () => {
            console.log("success");
        },
        onError: (error) => {
            console.log(error);
            //mostrar el eror en el formulario
        },
        onFinish: () => {
            console.log("finish");
        },
    });
};
</script>
