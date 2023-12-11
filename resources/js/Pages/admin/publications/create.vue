<template>
    <SimpleForm
        :formularioJson="formStructure"
        v-model="form"
        @onCancel="$emit('onCancel')"
        @onSumbit="submit"
    >
        <template #field.image>
            <v-alert v-if="form.errors.image" variant="tonal"   type="error" density="compact">
               {{ form.errors.image }}
            </v-alert>
            <v-card variant="tonal">
                <CropCompressImage
                    :aspect-ratio="16 / 9"
                    @onCropper="
                        (previewImg = $event.blob), (form.image = $event.file)
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
        </template>

        <template #field.documents>
            <v-btn
                color="primary"
                @click="addFile"
                prependIcon="mdi-plus"
                block
            >
                Agregar documento
            </v-btn>
            <v-card variant="tonal" v-for="(item, index) in form.documents">
                <v-card-item>
                    <v-row>
                        <v-col cols="12">
                            <v-text-field
                                class="mb-1 mt-2"
                                v-model="item.fileName"
                                label="Nombre del documento"
                                :error-messages="
                                    form.errors[`documents.${index}.fileName`]
                                "
                            >
                                <template v-slot:append>
                                    <v-btn
                                        color="red"
                                        density="comfortable"
                                        icon="mdi-close"
                                        variant="tonal"
                                        @click="removeFile(index)"
                                    />
                                </template>
                            </v-text-field>
                        </v-col>

                        <v-col cols="12" md="6">
                            <v-text-field
                                class="mb-1 mt-2"
                                v-model="item.fileDate"
                                label="Fecha de publicación"
                                type="date"
                                :error-messages="
                                    form.errors[`documents.${index}.fileDate`]
                                "
                            />
                        </v-col>

                        <v-col cols="12" md="6">
                            <v-file-input
                                @change="handleFileChangeDoc"
                                v-model="item.file"
                                show-size
                                single
                                label="Seleccione el documento"
                                accept="application/pdf"
                                class="mb-1 mt-2"

                                :error-messages="
                                    form.errors[`documents.${index}.file.0`]
                                    || form.errors[`documents.${index}.file`]
                                "
                            >
                            </v-file-input>
                        </v-col>
                    </v-row>
                </v-card-item>
            </v-card>
        </template>
    </SimpleForm>
</template>

<script setup>
import { ref } from "vue";
import SimpleForm from "@/components/SimpleForm.vue";
import { useForm } from "@inertiajs/vue3";
import CropCompressImage from "@/components/CropCompressImage.vue";
import { useObjectUrl } from "@vueuse/core";

const emit = defineEmits(["onCancel", "onSubmit"]);

const props = defineProps({
    formData: {
        type: Object,
        default: (props) =>
            props.formStructure?.reduce((acc, item) => {
                acc[item.key] = item.default;
                return acc;
            }, {}),
    },
    formStructure: {
        type: Array,
    },
    edit: {
        type: Boolean,
        default: false,
    },
    url: String,
});

const previewImg = ref(null);

const form = useForm({ ...props.formData, image: null, documents: [] });

const fileListDocs = ref([]);

const handleFileChangeDoc = (event) => {
    const files = event.target.files; // Obtén los archivos seleccionados
    const _fileList = []; // Array para almacenar los objetos de archivo

    // Recorre los archivos y crea un objeto para cada uno
    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const fileObject = {
            url: useObjectUrl(file),
            name: file.name,
            size: file.size,
            type: file.type,
        };

        _fileList.push(fileObject); // Agrega el objeto de archivo al array
    }

    // Asigna el array fileList a una propiedad en el data del componente
    fileListDocs.value = _fileList;
};
const addFile = () => {
    form.documents.push({
        fileName: null,
        file: null,
        fileDate: new Date().toISOString().slice(0, 10),
    });
};

const submit = async () => {
    form.post(props.url, option);
};

const option = {
    onSuccess: (page) => {
        console.log("onSuccess");
        emit("onCancel");
    },
    onError: (errors) => {
        console.log("onError");
    },
    onFinish: (visit) => {
        console.log("onFinish");
    },
};
</script>
