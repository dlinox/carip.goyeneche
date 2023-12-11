<template>
    <v-app id="inspire">
        <v-app-bar class="border-b" color="grey-lighten-4" elevation="0"  >
            <v-btn class="me-2" icon="mdi-menu" @click="drawer = !drawer">
            </v-btn>
            <v-spacer></v-spacer>
            <v-avatar
                @click="signOut"
                class="me-3"
                color="surface-variant"
                size="32"
                icon="mdi-logout"
                variant="flat"
            ></v-avatar>
        </v-app-bar>
        <v-navigation-drawer floating v-model="drawer" class="bg-grey-lighten-3 border-e" width="270">
            <v-toolbar >
                <v-list-item :title="user?.name" :subtitle="user?.role">
                    <template #prepend>
                        <v-avatar color="primary">
                            {{ user?.name[0] }}
                        </v-avatar>
                    </template>
                </v-list-item>
            </v-toolbar>

            <MenuApp  :userRole="user?.role" :userArea="user?.area_id" />
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

           
            <v-expansion-panels >
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
    </v-app>
</template>

<script setup>
import { ref, onMounted, computed, watch } from "vue";
import { router, usePage } from "@inertiajs/vue3";
import { useDisplay } from "vuetify";
import MenuApp from "@/components/layout/MenuApp.vue";

const { mobile } = useDisplay();
const drawer = ref(false);

onMounted(() => {
    drawer.value = !mobile.value;
    console.log(mobile.value);
});

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




</script>
