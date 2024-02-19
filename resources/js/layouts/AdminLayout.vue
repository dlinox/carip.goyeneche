<template>
    <v-app id="inspire">
        <v-app-bar class="border-b" color="grey-lighten-4" elevation="0">
            <v-btn class="me-2" icon="mdi-menu" @click="drawer = !drawer">
            </v-btn>
            <v-spacer></v-spacer>
            <v-menu transition="scale-transition">
                <template v-slot:activator="{ props }">
                    <v-btn
                        icon
                        color="primary"
                        v-bind="props"
                        density="comfortable"
                    >
                        <v-icon>mdi-account-circle</v-icon>
                    </v-btn>
                </template>

                <v-list nav>
                    <v-list-item
                        title="Cambiar contraseña"
                        @click="modalChangePassword = true"
                    >
                        <template #append>
                            <v-icon color="blue">mdi-lock-reset</v-icon>
                        </template>
                    </v-list-item>
                    <v-list-item title="Cerrar sesión" @click="signOut">
                        <template #append>
                            <v-icon color="red">mdi-logout</v-icon>
                        </template>
                    </v-list-item>
                </v-list>
            </v-menu>
        </v-app-bar>
        <v-navigation-drawer
            floating
            v-model="drawer"
            class="bg-grey-lighten-3 border-e"
            width="270"
        >
            <v-toolbar>
                <v-list-item :title="user?.name" :subtitle="user?.role">
                    <template #prepend>
                        <v-avatar color="primary">
                            {{ user?.name[0] }}
                        </v-avatar>
                    </template>
                </v-list-item>
            </v-toolbar>

            <MenuApp :userRole="user?.role" :userArea="user?.area_id" />
        </v-navigation-drawer>

        <v-main>
            <slot />
        </v-main>

        <v-snackbar v-model="snackbar" multi-line color="success" vertical>
            {{ flash.success }}

            <template v-slot:actions>
                <v-btn
                    color="dark"
                    variant="text"
                    @click="snackbar = false"
                    icon="mdi-close"
                ></v-btn>
            </template>
        </v-snackbar>

        <v-snackbar v-model="snackbarError" vertical multi-line color="error">
            <v-container>
                <v-expansion-panels>
                    <v-expansion-panel
                        elevation="0"
                        class="bg-transparent w-100"
                        :text="error.exception"
                    >
                        <v-expansion-panel-title
                            expand-icon="mdi-plus"
                            collapse-icon="mdi-minus"
                        >
                            {{ error.error }}
                        </v-expansion-panel-title>
                    </v-expansion-panel>
                </v-expansion-panels>
            </v-container>
            <template v-slot:actions>
                <v-btn
                    class="px-3"
                    color="white"
                    variant="tonal"
                    @click="snackbarError = false"
                >
                    Cerrar
                </v-btn>
            </template>
        </v-snackbar>

        <v-dialog v-model="modalChangePassword" max-width="500">
            <v-card>
                <v-card-title>
                    <span class="headline">Cambiar contraseña</span>
                </v-card-title>

                <v-card-text>
                    <v-form>
                        <v-text-field
                            v-model="form.password"
                            :rules="rules.password"
                            :counter="rules.password[0].length"
                            :error-messages="errorMessages.password"
                            label="Contraseña"
                            name="password"
                            prepend-icon="mdi-lock"
                            type="password"
                        ></v-text-field>
                    </v-form>
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="red"
                        variant="tonal"
                        @click="modalChangePassword = false"
                        :disabled="form.loading"
                    >
                        Cancelar
                    </v-btn>
                    <v-btn @click="changePassword" :disabled="form.loading">
                        Cambiar
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-app>
</template>

<script setup>
import { ref, onMounted, computed, watch, reactive } from "vue";
import { router, usePage } from "@inertiajs/vue3";
import { useDisplay } from "vuetify";
import MenuApp from "@/components/layout/MenuApp.vue";

const { mobile } = useDisplay();
const drawer = ref(false);
const modalChangePassword = ref(false);
onMounted(() => {
    drawer.value = !mobile.value;
    console.log(mobile.value);
});

const form = reactive({
    password: "",

    loading: false,
});

const rules = {
    password: [
        (v) => !!v || "La contraseña es requerida",
        (v) =>
            v.length >= 8 || "La contraseña debe tener al menos 8 caracteres",
    ],
};

const errorMessages = ref({
    password: [],
});

watch(
    () => form.password,
    (newValue) => {
        errorMessages.value.password = [];
        if (newValue.length < 8) {
            errorMessages.value.password.push(
                "La contraseña debe tener al menos 8 caracteres"
            );
        }
    }
);

const user = computed(() => usePage().props?.user);

const flash = computed(() => usePage().props?.flash);
const error = computed(() => usePage().props?.errors);

const snackbar = ref(false);
const snackbarError = ref(false);

watch(
    () => flash.value,
    (newValue) => {
        if (newValue && newValue.success) {
            snackbar.value = true;
        } else {
            snackbar.value = false;
        }
    }
);

watch(
    () => error.value,
    (newValue) => {
        if (newValue.exception && newValue.error) {
            snackbarError.value = true;
        } else {
            snackbarError.value = false;
        }
    }
);

const signOut = async () => {
    router.post("/auth/sign-out");
};

const changePassword = async () => {
    //validar formulario que la contraseña y la confirmacion sean iguales

    router.post("/auth/change-password", form, {
        onFinish() {
            modalChangePassword.value = false;
            form.password = "";
        },
    });
};
</script>
