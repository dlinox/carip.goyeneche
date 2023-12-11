<template>
    <v-app app>
        <v-form
            class="w-100 h-screen d-flex justify-center align-center"
            @submit.prevent="submit"
        >
            <v-card width="400">
                <v-card-item>
                    <v-img
                        class="mx-auto"
                        width="150"
                        src="/assets/logos/logo.png"
                    />
                </v-card-item>
                         
                <v-card-item>
                    <v-row>
                        <v-col cols="12" class="mt-2">
                            <v-text-field
                                v-model="form.password"
                                label="Nueva contraseña"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" class="mt-2">
                            <v-text-field
                                v-model="form.password_confirmation"
                                label="Confirmar nueva contraseña"
                            ></v-text-field>
                        </v-col>

                    </v-row>
                </v-card-item>
                <v-card-actions>
                    <v-btn type="submit" variant="flat" block color="primary">
                        Guardar
                    </v-btn>
                </v-card-actions>
                <v-card-actions>
                    <v-btn
                        type="button"
                        variant="text"
                        block
                        color="primary"
                        @click="router.get('/auth/login')"
                        > Iniciar sesión </v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-form>
    </v-app>
</template>

<script setup lang="ts">
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    token: {
        type: String,
        required: true,
    },
});

const form = ref({
    password: null,
    password_confirmation: null,
});

const submit = async () => {
    //validar que la contraseña sea igual a la confirmacion
    if (form.value.password !== form.value.password_confirmation) {
        alert("Las contraseñas no coinciden");
        return;
    }
    router.post("/auth/reset-password", { ...form.value, token: props.token });
    
};
</script>
