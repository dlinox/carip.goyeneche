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
                
                    <v-alert variant="text">
                        Recibirás un correo con un enlace para restablecer tu
                        contraseña. Por favor, verifica tu bandeja de entrada (y
                        la carpeta de correo no deseado) en los próximos
                        minutos.
                    </v-alert>
                
                <v-card-item>
                    <v-row>
                        <v-col cols="12" class="mt-2">
                            <v-text-field
                                v-model="form.email"
                                label="Correo"
                                :error-messages="form.errors.email"
                            ></v-text-field>
                        </v-col>
                    </v-row>
                </v-card-item>
                <v-card-actions>
                    <v-btn 
                    :loading="form.processing"
                    type="submit" variant="flat" block color="primary">
                        Enviar
                    </v-btn>
                </v-card-actions>
                <v-card-actions>
                    <v-btn
                        
                        type="button"
                        variant="text"
                        block
                        color="primary"
                        @click="router.get('/auth/login')"
                        > Iniciar sesion </v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-form>
    </v-app>
</template>

<script setup>
import { router, useForm } from "@inertiajs/vue3";

const form = useForm({
    email: null,
});

const submit = async () => {
    form.post("/auth/forgot-password", {
        onSuccess: () => {
            form.email = null;
            alert("Se ha enviado un correo con el enlace para restablecer tu contraseña.");
        },
    });
};
</script>
