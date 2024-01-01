<template>
    <AuthLayout :title="title">
        <v-form
            class="w-100 h-screen d-flex justify-center align-center"
            @submit.prevent="signInHandler"
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
                                v-model="form.email"
                                label="Correo"
                                :error-messages="form.errors.email"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" class="mt-2">
                            <v-text-field
                                v-model="form.password"
                                type="password"
                                label="Contraseña"
                                :error-messages="form.errors.password"
                            ></v-text-field>
                        </v-col>
                    </v-row>
                </v-card-item>
                <v-card-actions>
                    <v-btn type="submit" block :loading="form.processing">
                        Ingresar
                    </v-btn>
                </v-card-actions>
                <v-card-actions>
                    <v-btn
                        type="button"
                        variant="text"
                        block
                        color="primary"
                        @click="router.get('/auth/forgot-password')"
                        >Olvidé mi contraseña</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-form>
    </AuthLayout>
</template>
<script setup>
import AuthLayout from "@/layouts/AuthLayout.vue";
import { router, useForm } from "@inertiajs/vue3";

const props = defineProps({
    title: String,
});

const form = useForm({
    email: "",
    password: "",
});

const signInHandler = async () => {
    form.post("/auth/sign-in");
};
</script>
