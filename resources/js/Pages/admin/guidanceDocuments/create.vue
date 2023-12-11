<template>
    <SimpleForm
        :formularioJson="formStructure"
        v-model="form"
        @onCancel="$emit('onCancel')"
        @onSumbit="submit"
    >
        <template #field.guide_file>
            <v-alert v-if="form.errors.guide_file" variant="tonal"   type="error" density="compact">
               {{ form.errors.guide_file }}
            </v-alert>
            <v-card variant="tonal">
                <CropCompressImage
                    :aspect-ratio="16 / 9"
                    @onCropper="
                        (previewImg1 = $event.blob),
                            (form.guide_file = $event.file)
                    "
                />

                <v-img
                    v-if="previewImg1"
                    class="mx-auto"
                    :width="300"
                    aspect-ratio="16/9"
                    cover
                    :src="previewImg1"
                ></v-img>

                <v-img
                    v-if="form.guide_file_url && !previewImg1"
                    class="mx-auto"
                    :width="300"
                    aspect-ratio="16/9"
                    cover
                    :src="form.guide_file_url"
                ></v-img>
            </v-card>
        </template>

        <template #field.resolution_file>

            <v-alert v-if="form.errors.resolution_file" variant="tonal"   type="error" density="compact">
               {{ form.errors.image }}
            </v-alert>
            <v-card variant="tonal">
                <CropCompressImage
                    :aspect-ratio="16 / 9"
                    @onCropper="
                        (previewImg2 = $event.blob),
                            (form.resolution_file = $event.file)
                    "
                />

                <v-img
                    v-if="previewImg2"
                    class="mx-auto"
                    :width="300"
                    aspect-ratio="16/9"
                    cover
                    :src="previewImg2"
                ></v-img>

                <v-img
                    v-if="form.resolution_file_url && !previewImg2"
                    class="mx-auto"
                    :width="300"
                    aspect-ratio="16/9"
                    cover
                    :src="form.resolution_file_url"
                ></v-img>
            </v-card>
        </template>
    </SimpleForm>
</template>

<script setup>
import { ref } from "vue";
import SimpleForm from "@/components/SimpleForm.vue";
import { useForm } from "@inertiajs/vue3";
import { useObjectUrl } from "@vueuse/core";
import CropCompressImage from "@/components/CropCompressImage.vue";
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

const previewImg1 = ref(null);
const previewImg2 = ref(null);

const form = useForm({
    ...props.formData,
    guide_file: null,
    resolution_file: null,
});

const submit = async () => {
    form.transform((data) => ({
        ...data,
    })).post(props.url, option);
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
