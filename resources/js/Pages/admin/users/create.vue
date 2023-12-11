<template>
    <SimpleForm
        :formularioJson="formStructure"
        v-model="form"
        @onCancel="$emit('onCancel')"
        @onSumbit="submit"
    >
        <template v-slot:field.role="{ _field }">
            <v-combobox
                v-model="form.role"
                :items="_field.options"
                :label="_field.label"
                :itemValue="_field.itemValue"
                :itemTitle="_field.itemTitle"
                @update:modelValue="onSelectRole"
            ></v-combobox>
        </template>

        <template v-slot:field.area_id="{ _field }">
            <v-combobox
                v-model="form.area_id"
                :items="_field.options"
                :label="_field.label"
                :itemValue="_field.itemValue"
                :itemTitle="_field.itemTitle"
                :return-object="false"
                :rules="
                    form.role === 'Administrador'
                        ? []
                        : [() => !!form.area_id || 'Campo Obligatorio.']
                "
                placeholder="Seleccione un area"
            ></v-combobox>
        </template>

        <template v-slot:field.permissions="{ _field }">
            <v-combobox
                v-model="form.permissions"
                :items="_field.options"
                :label="_field.label"
                :itemValue="_field.itemValue"
                :itemTitle="_field.itemTitle"
                multiple
                chips
            ></v-combobox>
        </template>
    </SimpleForm>
</template>

<script setup>
import { ref } from "vue";
import SimpleForm from "@/components/SimpleForm.vue";
import { useForm } from "@inertiajs/vue3";
const emit = defineEmits(["onCancel", "onSubmit"]);

const props = defineProps({
    formData: {
        type: Object,
        default: (props) =>
            props.formStructure?.reduce((acc, item) => {
                acc[item.key] = item.default;
                //el password no se debe enviar en el formulario cuando se esta editando
                if (item.key === "password" && props.edit) {
                    delete acc[item.key];
                }
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

const onSelectRole = (value) => {

    if (value === "Administrador") {
        props.formStructure.map((item) => {
            if (item.key === "area_id") {
                item.required = false;
            }
        });
    } else {
        props.formStructure.map((item) => {
            if (item.key === "area_id") {
                item.required = true;
            }
        });
    }
};

const form = useForm({ ...props.formData });

const submit = async () => {

    if (props.edit) {
         form.put(props.url, option);
    } else {
        form.post(props.url, option);
    }
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
