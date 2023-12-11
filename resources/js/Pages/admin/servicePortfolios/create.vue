<template>
    <SimpleForm
        :formularioJson="formStructure"
        v-model="form"
        @onCancel="$emit('onCancel')"
        @onSumbit="submit"
    >
        <template #field.guide_file>
            <v-list-item class="py-0">
                <v-file-input
                    @change="handleFileChangeDoc"
                    v-model="form.guide_file"
                    show-size
                    single
                    :clearable="false"
                    label="Seleccione el documento"
                    accept="application/pdf"
                    class="mb-1 mt-2"
                    :error-messages="form.errors.guide_file"
                >
                    <template v-if="form.guide_file" #append>
                        <v-btn
                            variant="tonal"
                            rounded="lg"
                            icon="mdi-close"
                            size="small"
                            @click="cancelUploadGuide"
                        />
                    </template>
                </v-file-input>
            </v-list-item>

            <v-card variant="tonal">
                <v-list-item
                    v-for="(file, fileIndex) in fileListDocs"
                    :key="file.name"
                >
                    <template v-slot:prepend>
                        <a :href="file.url" target="_blank" class="me-3">
                            <v-icon color="red" icon="mdi-file-pdf-box">
                            </v-icon>
                        </a>
                    </template>

                    <v-list-item-title>
                        <small> {{ file.name }} </small>
                    </v-list-item-title>
                    <v-list-item-subtitle>
                        {{ file.size }} bytes
                    </v-list-item-subtitle>

                    <v-list-item-subtitle class="text-red">
                        <!-- <small>
                            {{ form.errors.docu_plantilla }}
                        </small> -->
                    </v-list-item-subtitle>
                </v-list-item>
            </v-card>
        </template>

        <template #field.resolution_file>
            <v-list-item class="py-0">
                <v-file-input
                    @change="handleFileChangeResolution"
                    v-model="form.resolution_file"
                    show-size
                    single
                    :clearable="false"
                    label="Seleccione el documento"
                    accept="application/pdf"
                    class="mb-1 mt-2"
                    :error-messages="form.errors.resolution_file"
                >
                    <template v-if="form.resolution_file" #append>
                        <v-btn
                            variant="tonal"
                            rounded="lg"
                            icon="mdi-close"
                            size="small"
                            @click="cancelUploadResolution"
                        />
                    </template>
                </v-file-input>
            </v-list-item>

            <v-card variant="tonal">
                <v-list-item
                    v-for="(file, fileIndex) in fileListResolution"
                    :key="file.name"
                >
                    <template v-slot:prepend>
                        <a :href="file.url" target="_blank" class="me-3">
                            <v-icon color="red" icon="mdi-file-pdf-box">
                            </v-icon>
                        </a>
                    </template>

                    <v-list-item-title>
                        <small> {{ file.name }} </small>
                    </v-list-item-title>
                    <v-list-item-subtitle>
                        {{ file.size }} bytes
                    </v-list-item-subtitle>

                    <v-list-item-subtitle class="text-red">
                        <!-- <small>
                            {{ form.errors.docu_plantilla }}
                        </small> -->
                    </v-list-item-subtitle>
                </v-list-item>
            </v-card>
        </template>
    </SimpleForm>
</template>

<script setup>
import { ref } from "vue";
import SimpleForm from "@/components/SimpleForm.vue";
import { useForm } from "@inertiajs/vue3";
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

const form = useForm({
    ...props.formData,
    guide_file: null,
    resolution_file: null,
});

const submit = async () => {

    console.log(form);

    form.transform((data) => ({
        ...data,
        guide_file: data.guide_file ? data.guide_file[0] : null,
        resolution_file: data.resolution_file ? data.resolution_file[0] : null,
    })).post(props.url, option);
};

const fileListDocs = ref([]);
const fileListResolution = ref([]);

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

const handleFileChangeResolution = (event) => {
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
    fileListResolution.value = _fileList;
};

const cancelUploadGuide = () => {
    fileListDocs.value = [];
    form.guide_file = null;
};

const cancelUploadResolution = () => {
    fileListResolution.value = [];
    form.resolution_file = null;
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
