<template>
    <AdminLayout>
        <HeadingPage :title="news ? 'Editar Noticia' : 'Nueva Noticia'" subtitle="Gestion de Noticias">
            <template #actions> </template>
        </HeadingPage>
        <v-container fluid>
            <v-form @submit.prevent="submit">
                <v-row>
                    <v-col cols="12" md="8">
                        <v-row>
                            <v-col cols="12">
                                <v-text-field
                                    v-model="form.title"
                                    label="Titulo"
                                    :rules="[
                                        (v) => !!v || 'El titulo es requerido',
                                    ]"
                                    :error-messages="form.errors.title"
                                ></v-text-field>
                            </v-col>

                            <v-col cols="12">
                                <v-textarea
                                    v-model="form.description"
                                    label="Descripción"
                                    :rules="[
                                        (v) =>
                                            !!v ||
                                            'La descripción es requerida',
                                    ]"
                                    :error-messages="form.errors.description"
                                ></v-textarea>
                            </v-col>

                            <v-col cols="12">
                                <small class="text-red pa-2">
                                    {{ form.errors.content }}
                                </small>
                                <v-card style="min-height: 200px">
                                    <quill-editor
                                        contentType="html"
                                        v-model:content="form.content"
                                        theme="snow"
                                    ></quill-editor>
                                </v-card>
                            </v-col>
                        </v-row>
                    </v-col>
                    <v-col cols="12" md="4">
                        <v-row>
                            <v-col cols="12">
                                <v-card variant="tonal">
                                    <small class="text-red pa-2">
                                        {{ form.errors.image }}
                                    </small>
                                    <CropCompressImage
                                        :aspect-ratio="16 / 9"
                                        @onCropper="
                                            (previewImg = $event.blob),
                                                (form.image = $event.file)
                                        "
                                    />

                                    <v-img
                                        v-if="previewImg"
                                        class="mx-auto"
                                        :width="300"
                                        aspect-ratio="16/9"
                                        cover
                                        :src="previewImg"
                                    ></v-img>

                                    <v-img
                                        v-if="form.image_url && !previewImg"
                                        class="mx-auto"
                                        :width="300"
                                        aspect-ratio="16/9"
                                        cover
                                        :src="form.image_url"
                                    ></v-img>
                                </v-card>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field
                                    v-model="form.date_publish"
                                    type="date"
                                    label="Fecha de publicación"
                                    :rules="[
                                        (v) =>
                                            !!v ||
                                            'La fecha de publicación es requerida',
                                    ]"
                                    :error-messages="form.errors.date_publish"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field
                                    v-model="form.external_link"
                                    label="Link externo"
                                    :error-messages="form.errors.external_link"
                                ></v-text-field>
                            </v-col>

                            <v-col cols="12">
                                <v-btn
                                    color="primary"
                                    type="submit"
                                    block
                                    :loading="form.processing"
                                >
                                    Guardar
                                </v-btn>
                            </v-col>
                        </v-row>
                    </v-col>
                </v-row>
            </v-form>
        </v-container>

    </AdminLayout>
</template>
<script setup>
import AdminLayout from "@/layouts/AdminLayout.vue";
import HeadingPage from "@/components/HeadingPage.vue";
import CropCompressImage from "@/components/CropCompressImage.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { router } from "@inertiajs/core";

const props = defineProps({
    news: Object,
});

const url = "/a/news";

const form = useForm({
    title: "",
    description: "",
    content: "",
    image: null,
    date_publish: "",
    external_link: "",
    ...props.news,
    image: null,
});

const previewImg = ref(null);

const submit = async () => {
    console.log(form);
    form.post(url, option);
};

const option = {
    onSuccess: (page) => {
        console.log("onSuccess");
        router.get(url);
    },
    onError: (errors) => {
        console.log("onError");
    },
    onFinish: (visit) => {
        console.log("onFinish");
    },
};
</script>
